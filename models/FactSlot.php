<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fact_slot".
 *
 * @property int $id
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $datatype
 * @property string $datavalue
 * @property int $fact_id
 *
 * @property Fact $fact
 */
class FactSlot extends \yii\db\ActiveRecord
{
 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fact_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'datavalue'], 'required'],
            [['datatype', 'fact_id'], 'integer'],
            [['name', 'shortname', 'datavalue'], 'string', 'max' => 100],
            [['description','vardatavalue'], 'string', 'max' => 255],
            [['fact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fact::className(), 'targetAttribute' => ['fact_id' => 'id']],
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
            'description' => 'Описание',
            'datatype' => 'Тип данных',
            'datavalue' => 'Значение',
            'vardatavalue'=>'Возможные значения',
            'fact_id' => 'Начальный факт',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFact()
    {
        return $this->hasOne(Fact::className(), ['id' => 'fact_id']);
    }

    public function newName($fact_id) 
    {
        return "Slot-0"  . (string)(self::getCount($fact_id)+1); 
    }
   
    public function beforeSave($insert)
	{
		if (parent::beforeValidate($insert)) {
            $this->shortname =  Yii::$app->utils->transliteration($this->name);
			return true;
		}  
		return false;		
    }
}
