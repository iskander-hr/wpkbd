<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fact_slot}}`.
 */
class m191101_011046_create_fact_slot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fact_slot}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'description' => $this->string(255),
            'datatype' => $this->integer(1)->defaultvalue(1),
            'datavalue' => $this->string(100),
			'vardatavalue'=>$this->string(),
            'fact_id' => $this->integer()->NotNull(),
        ]);

        // creates index for column `fact_id`
        $this->createIndex(
            '{{%idx-fact_slot-fact_id}}',
            '{{%fact_slot}}',
            'fact_id'
        );

        // add foreign key for table `{{%fact}}`
        $this->addForeignKey(
            '{{%fk-fact_slot-fact_id}}',
            '{{%fact_slot}}',
            'fact_id',
            '{{%fact}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%fact}}`
        $this->dropForeignKey(
            '{{%fk-fact_slot-fact_id}}',
            '{{%fact_slot}}'
        );

        // drops index for column `fact_id`
        $this->dropIndex(
            '{{%idx-fact_slot-fact_id}}',
            '{{%fact_slot}}'
        );

        $this->dropTable('{{%fact_slot}}');
    }
}
