<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule_slot".
 *
 * @property int $id
 * @property string $name
 * @property string $shortname
 * @property int $datatype
 * @property string $datavalue
 * @property string $vardatavalue
 * @property int $ruletemplate_id
 *
 * @property RuleTemplate $ruletemplate
 */
class RuleSlot extends \yii\db\ActiveRecord
{
  
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'shortname', 'datavalue', 'ruletemplate_id'], 'required'],
            [['datatype', 'ruletemplate_id'], 'integer'],
            [['name', 'shortname'], 'string', 'max' => 100],
            [['datavalue', 'vardatavalue'], 'string', 'max' => 255],
            [['ruletemplate_id'], 'exist', 'skipOnError' => true, 'targetClass' => RuleTemplate::className(), 'targetAttribute' => ['ruletemplate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'shortname' => 'Служебное имя',
            'datatype' => 'Тип данных',
            'datavalue' => 'Значение',
            'vardatavalue' => 'Возможные значения',
            'ruletemplate_id' => 'Шаблоны',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuletemplate()
    {
        return $this->hasOne(RuleTemplate::className(), ['id' => 'ruletemplate_id']);
    }
}
