<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fact".
 *
 * @property int $id
 * @property string $uin
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $knowlegebase_id
 * @property int $template_id
 *
 * @property Knowlegebase $knowlegebase
 * @property FactSlot[] $factSlots
 */
class Fact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name','template_id'], 'required'],
            [['knowlegebase_id', 'template_id'], 'integer'],
            [['uin'], 'string', 'max' => 7],
            [['name', 'shortname'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['knowlegebase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Knowlegebase::className(), 'targetAttribute' => ['knowlegebase_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uin' => 'UIN',
            'name' => 'Имя',
            'shortname' => 'Служебное имя',
            'description' => 'Описание',
            'knowlegebase_id' => 'База знаний',
            'template_id' => 'Шаблон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKnowlegebase()
    {
        return $this->hasOne(Knowlegebase::className(), ['id' => 'knowlegebase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactSlots()
    {
        return $this->hasMany(FactSlot::className(), ['fact_id' => 'id']);
    }

    public function getAllSlotName($id) {

        $slots = FactSlot::find()->where(['fact_id' => $id])->all();
        $ret ="";
        if (!$slots) return "У начального факта  нет слотов";
        foreach($slots as $slot) 
            $ret .="<h5>{$slot['name']} / <small>{$slot['datavalue']}</small></h5>";
        return $ret;
    }

    public function getFactName($id)
    {
        $name = '';
        $name = Fact::find()->where(['id' => $id])->one();
        return  $name->name;   
    }

    public function getCount()
    {
      return  Fact::find()->where(['knowlegebase_id' => \Yii::$app->session['KnowlegebaseID']])->count();
    }

    public function newName() 
    {
        return "Факт-F00"  . (string)(self::getCount()+1); 
    }
   
    public function newUin() 
    {
        return 'F00' . (string)(self::getCount()+1);  
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        foreach (TemplateSlot::find()->where(['template_id' => $this->template_id])->all() as $TemplateSlot) {
            $FactSlot = new FactSlot();
            $FactSlot->name = $TemplateSlot->name;
            $FactSlot->shortname = $TemplateSlot->shortname;
            $FactSlot->description = $TemplateSlot->description;
            $FactSlot->datatype = $TemplateSlot->datatype;
            $FactSlot->vardatavalue = $TemplateSlot->datavalue;
            //разбор на части datavalue
            if (stripos($TemplateSlot->datavalue, ";") !== false) {
                $value = explode(";", $TemplateSlot->datavalue);
                $FactSlot->datavalue = $value[0];
            }
            else     
            $FactSlot->datavalue = $TemplateSlot->datavalue;

            
            $FactSlot->fact_id = $this->id;
            $FactSlot->save(); 
        }
    }

    public function beforeSave($insert)
	{
		if (parent::beforeValidate($insert)) {
            $this->shortname =  Yii::$app->utils->transliteration($this->name);
            $this->knowlegebase_id = \Yii::$app->session['KnowlegebaseID'];
            \Yii::$app->session['FactID'] =  $this->id;
			return true;
		}  
		return false;		
    }
}
