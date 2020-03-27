<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%template_slot}}`.
 */
class m191101_010946_create_template_slot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%template_slot}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'description' => $this->string(255),
            'datatype' => $this->integer(1)->defaultvalue(1),
            'datavalue' => $this->string(),
            'template_id' => $this->integer()->NotNull(),
        ]);

        // creates index for column `template_id`
        $this->createIndex(
            '{{%idx-template_slot-template_id}}',
            '{{%template_slot}}',
            'template_id'
        );

        // add foreign key for table `{{%template}}`
        $this->addForeignKey(
            '{{%fk-template_slot-template_id}}',
            '{{%template_slot}}',
            'template_id',
            '{{%template}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%template}}`
        $this->dropForeignKey(
            '{{%fk-template_slot-template_id}}',
            '{{%template_slot}}'
        );

        // drops index for column `template_id`
        $this->dropIndex(
            '{{%idx-template_slot-template_id}}',
            '{{%template_slot}}'
        );

        $this->dropTable('{{%template_slot}}');
    }
}
