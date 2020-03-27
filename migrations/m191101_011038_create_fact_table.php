<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fact}}`.
 */
class m191101_011038_create_fact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fact}}', [
            'id' => $this->primaryKey(),
            'uin' => $this->string(7)->notNull(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'description' => $this->string(255),
            'knowlegebase_id' => $this->integer()->NotNull(),
            'template_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `knowlegebase_id`
        $this->createIndex(
            '{{%idx-fact-knowlegebase_id}}',
            '{{%fact}}',
            'knowlegebase_id'
        );

        // add foreign key for table `{{%knowlegebase}}`
        $this->addForeignKey(
            '{{%fk-fact-knowlegebase_id}}',
            '{{%fact}}',
            'knowlegebase_id',
            '{{%knowlegebase}}',
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
            '{{%fk-fact-knowlegebase_id}}',
            '{{%fact}}'
        );

        // drops index for column `knowlegebase_id`
        $this->dropIndex(
            '{{%idx-fact-knowlegebase_id}}',
            '{{%fact}}'
        );

        $this->dropTable('{{%fact}}');
    }
}
