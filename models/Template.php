<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property int $id
 * @property string $uin
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $knowlegebase_id
 *
 * @property Knowlegebase $knowlegebase
 * @property TemplateSlot[] $templateSlots
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['knowlegebase_id'], 'integer'],
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
            'description' => 'Описания',
            'knowlegebase_id' => 'База знаний',
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
    public function getTemplateSlots()
    {
        return $this->hasMany(TemplateSlot::className(), ['template_id' => 'id']);
    }


    public function getAllSlotName($id) {

        $slots = TemplateSlot::find()->where(['template_id' => $id])->all();
        $ret ="";
        if (!$slots) return "У шаблона нет слотов";
        foreach($slots as $slot) 
            $ret .="<h5>{$slot['name']} / <small>{$slot['datavalue']}</small></h5>";
        return $ret;
    }
    
    public function getTemplateName($id)
    {
        $name = '';
        $name = Template::find()->where(['id' => $id])->one();
        return  $name->name;   
    }

    public function getCount()
    {
      return  Template::find()->where(['knowlegebase_id' => \Yii::$app->session['KnowlegebaseID']])->count();
    }

    public function newName() 
    {
        return "Шаблон-Т00"  . (string)(self::getCount()+1); 
    }
   
    public function newUin() 
    {
        return 'Т00' . (string)(self::getCount()+1);  
    }

    public function beforeSave($insert)
	{
		if (parent::beforeValidate($insert)) {
            $this->shortname =  \Yii::$app->utils->transliteration($this->name);
            $this->knowlegebase_id = \Yii::$app->session['KnowlegebaseID'];
            \Yii::$app->session['TemplateID'] =  $this->id;
			return true;
		}  
		return false;		
    }
}
