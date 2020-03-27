<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%grule}}`.
 */
class m191101_011640_create_grule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%grule}}', [
            'id' => $this->primaryKey(),
            'uin' => $this->string(7)->notNull(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'description' => $this->string(255),
            'knowlegebase_id' => $this->integer()->NotNull(),
        ]);

        // creates index for column `knowlegebase_id`
        $this->createIndex(
            '{{%idx-grule-knowlegebase_id}}',
            '{{%grule}}',
            'knowlegebase_id'
        );

        // add foreign key for table `{{%knowlegebase}}`
        $this->addForeignKey(
            '{{%fk-grule-knowlegebase_id}}',
            '{{%grule}}',
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
            '{{%fk-grule-knowlegebase_id}}',
            '{{%grule}}'
        );

        // drops index for column `knowlegebase_id`
        $this->dropIndex(
            '{{%idx-grule-knowlegebase_id}}',
            '{{%grule}}'
        );

        $this->dropTable('{{%grule}}');
    }

}
