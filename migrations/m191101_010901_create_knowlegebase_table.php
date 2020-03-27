<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%knowlegebase}}`.
 */
class m191101_010901_create_knowlegebase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%knowlegebase}}', [
            'id' => $this->primaryKey(),
            'uin' => $this->string(20)->notNull(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'description' => $this->string(),
            'author' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%knowlegebase}}');
    }
}
