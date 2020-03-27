<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%template}}`.
 */
class m191101_010939_create_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%template}}', [
            'id' => $this->primaryKey(), 
            'uin' => $this->string(7)->notNull(),
            'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'description' => $this->string(255),
            'knowlegebase_id' => $this->integer()->NotNull(),
        ]);

        // creates index for column `knowlegebase_id`
        $this->createIndex(
            '{{%idx-template-knowlegebase_id}}',
            '{{%template}}',
            'knowlegebase_id'
        );

        // add foreign key for table `{{%knowlegebase}}`
        $this->addForeignKey(
            '{{%fk-template-knowlegebase_id}}',
            '{{%template}}',
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
            '{{%fk-template-knowlegebase_id}}',
            '{{%template}}'
        );

        // drops index for column `knowlegebase_id`
        $this->dropIndex(
            '{{%idx-template-knowlegebase_id}}',
            '{{%template}}'
        );

        $this->dropTable('{{%template}}');
    }
}
