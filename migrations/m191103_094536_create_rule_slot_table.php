<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rule_slot}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rule_template}}`
 */
class m191103_094536_create_rule_slot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rule_slot}}', [
            'id' => $this->primaryKey(),
			'name' => $this->string(100)->notNull(),
            'shortname' => $this->string(100)->notNull(),
            'datatype' => $this->integer(1)->defaultvalue(1),
            'datavalue' => $this->string()->notNull(),
            'vardatavalue' => $this->string(),
            'ruletemplate_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `ruletemplate_id`
        $this->createIndex(
            '{{%idx-rule_slot-ruletemplate_id}}',
            '{{%rule_slot}}',
            'ruletemplate_id'
        );

        // add foreign key for table `{{%rule_template}}`
        $this->addForeignKey(
            '{{%fk-rule_slot-ruletemplate_id}}',
            '{{%rule_slot}}',
            'ruletemplate_id',
            '{{%rule_template}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%rule_template}}`
        $this->dropForeignKey(
            '{{%fk-rule_slot-ruletemplate_id}}',
            '{{%rule_slot}}'
        );

        // drops index for column `ruletemplate_id`
        $this->dropIndex(
            '{{%idx-rule_slot-ruletemplate_id}}',
            '{{%rule_slot}}'
        );

        $this->dropTable('{{%rule_slot}}');
    }
}
