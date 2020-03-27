<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rule}}`.
 */
class m191101_012010_create_rule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rule}}', [
            'id' => $this->primaryKey(),
            'uin' => $this->string(7)->notNull(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
			'description' => $this->string(255),
            'knowlegebase_id' => $this->integer()->NotNull(),
            'grule_id' => $this->integer()->NotNull(),
        ]);

        // creates index for column `knowlegebase_id`
        $this->createIndex(
            '{{%idx-rule-knowlegebase_id}}',
            '{{%rule}}',
            'knowlegebase_id'
        );

        // add foreign key for table `{{%knowlegebase}}`
        $this->addForeignKey(
            '{{%fk-rule-knowlegebase_id}}',
            '{{%rule}}',
            'knowlegebase_id',
            '{{%knowlegebase}}',
            'id',
            'CASCADE'
        );

        // creates index for column `grule_id`
        $this->createIndex(
            '{{%idx-rule-grule_id}}',
            '{{%rule}}',
            'grule_id'
        );

        // add foreign key for table `{{%grule}}`
        $this->addForeignKey(
            '{{%fk-rule-grule_id}}',
            '{{%rule}}',
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
        // drops foreign key for table `{{%knowlegebase}}`
        $this->dropForeignKey(
            '{{%fk-rule-knowlegebase_id}}',
            '{{%rule}}'
        );

        // drops index for column `knowlegebase_id`
        $this->dropIndex(
            '{{%idx-rule-knowlegebase_id}}',
            '{{%rule}}'
        );

        // drops foreign key for table `{{%grule}}`
        $this->dropForeignKey(
            '{{%fk-rule-grule_id}}',
            '{{%rule}}'
        );

        // drops index for column `grule_id`
        $this->dropIndex(
            '{{%idx-rule-grule_id}}',
            '{{%rule}}'
        );

        $this->dropTable('{{%rule}}');
    }
}
