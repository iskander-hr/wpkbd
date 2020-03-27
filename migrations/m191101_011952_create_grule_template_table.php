<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%grule_template}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%template}}`
 * - `{{%grule}}`
 */
class m191101_011952_create_grule_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%grule_template}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(1)->defaultvalue(1),
            'template_id' => $this->integer()->notNull(),
            'grule_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `template_id`
        $this->createIndex(
            '{{%idx-grule_template-template_id}}',
            '{{%grule_template}}',
            'template_id'
        );

        // add foreign key for table `{{%template}}`
        $this->addForeignKey(
            '{{%fk-grule_template-template_id}}',
            '{{%grule_template}}',
            'template_id',
            '{{%template}}',
            'id',
            'CASCADE'
        );

        // creates index for column `grule_id`
        $this->createIndex(
            '{{%idx-grule_template-grule_id}}',
            '{{%grule_template}}',
            'grule_id'
        );

        // add foreign key for table `{{%grule}}`
        $this->addForeignKey(
            '{{%fk-grule_template-grule_id}}',
            '{{%grule_template}}',
            'grule_id',
            '{{%grule}}',
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
            '{{%fk-grule_template-template_id}}',
            '{{%grule_template}}'
        );

        // drops index for column `template_id`
        $this->dropIndex(
            '{{%idx-grule_template-template_id}}',
            '{{%grule_template}}'
        );

        // drops foreign key for table `{{%grule}}`
        $this->dropForeignKey(
            '{{%fk-grule_template-grule_id}}',
            '{{%grule_template}}'
        );

        // drops index for column `grule_id`
        $this->dropIndex(
            '{{%idx-grule_template-grule_id}}',
            '{{%grule_template}}'
        );

        $this->dropTable('{{%grule_template}}');
    }
}
