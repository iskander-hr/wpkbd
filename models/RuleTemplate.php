<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule_template".
 *
 * @property int $id
 * @property int $type
 * @property int $template_id
 * @property int $rule_id
 *
 * @property Rule $rule
 */
class RuleTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'template_id', 'rule_id'], 'integer'],
            [['template_id', 'rule_id'], 'required'],
            [['rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rule::className(), 'targetAttribute' => ['rule_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'template_id' => 'Шаблон',
            'rule_id' => 'Правило',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule()
    {
        return $this->hasOne(Rule::className(), ['id' => 'rule_id']);
    }
}
