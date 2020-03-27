<?php

namespace app\models;
//use app\components\UppercaseBehavior;
use Yii;

/**
 * This is the model class for table "template_slot".
 *
 * @property int $id
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $datatype
 * @property string $datavalue
 * @property int $template_id
 *
 * @property Template $template
 */
class TemplateSlot extends \yii\db\ActiveRecord
{
  	/*public function behaviors() {
         return [
            UppercaseBehavior::className(),
         ];
      }*/
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_slot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','datavalue'], 'required'],
            [['datatype', 'template_id'], 'integer'],
            [['name', 'shortname'], 'string', 'max' => 100],
            [['description', 'datavalue'], 'string', 'max' => 255],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::className(), 'targetAttribute' => ['template_id' => 'id']],
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
            'template_id' => 'Шаблон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }

    public function getCount($template_id)
    {
      return  TemplateSlot::find()->where(['template_id' => $template_id])->count();
    }

    public function newName($template_id) 
    {
        return "Slot-0"  . (string)(self::getCount($template_id)+1); 
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
