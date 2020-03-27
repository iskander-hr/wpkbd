<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rule_template}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rule}}`
 */
class m191103_082408_create_rule_template_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rule_template}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(1)->defaultvalue(1),
            'template_id' => $this->integer()->notNull(),
            'rule_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `rule_id`
        $this->createIndex(
            '{{%idx-rule_template-rule_id}}',
            '{{%rule_template}}',
            'rule_id'
        );

        // add foreign key for table `{{%rule}}`
        $this->addForeignKey(
            '{{%fk-rule_template-rule_id}}',
            '{{%rule_template}}',
            'rule_id',
            '{{%rule}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%rule}}`
        $this->dropForeignKey(
            '{{%fk-rule_template-rule_id}}',
            '{{%rule_template}}'
        );

        // drops index for column `rule_id`
        $this->dropIndex(
            '{{%idx-rule_template-rule_id}}',
            '{{%rule_template}}'
        );

        $this->dropTable('{{%rule_template}}');
    }
}
