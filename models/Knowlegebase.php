<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "knowlegebase".
 *
 * @property int $id
 * @property string $uin
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property string $author
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Template[] $templates
 */
class Knowlegebase extends \yii\db\ActiveRecord
{
    public $gen_code = "Нет сгенерированных данных";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'knowlegebase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['uin'], 'string', 'max' => 20],
            [['name', 'shortname'], 'string', 'max' => 100],
            [['description', 'author'], 'string', 'max' => 255],
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
            'author' => 'Автор',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplates()
    {
        return $this->hasMany(Template::className(), ['knowlegebase_id' => 'id']);
    }

    public function getCount()
    {
      return  Knowlegebase::find()->count();  
    }

    public function newName() 
    {
        return "База знаний №" . (string)(self::getCount()+1); 
    }
   
    public function newUin() 
    {
        return 'B00' . (string)(self::getCount()+1);  
    }

    public function getKnowlegebaseName($id)
    {
        $name = '';
        $name = Knowlegebase::find()->where(['id' => $id])->one();
        return  $name->name;   
    }
    
    public function beforeSave($insert)
	{
		if (parent::beforeValidate($insert)) {
            $this->shortname =  Yii::$app->utils->transliteration($this->name);  
            $this->author = Yii::$app->user->identity->username;
			return true;
		}  
		return false;		
    }


}
