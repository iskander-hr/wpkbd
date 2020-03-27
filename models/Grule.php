<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grule".
 *
 * @property int $id
 * @property string $uin
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $knowlegebase_id
 *
 * @property Knowlegebase $knowlegebase
 * @property GruleAction[] $gruleActions
 * @property GruleCondition[] $gruleConditions
 */
class Grule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grule';
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
            'description' => 'Описание',
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
    public function getGruleActions()
    {
        return $this->hasMany(GruleAction::className(), ['grule_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGruleConditions()
    {
        return $this->hasMany(GruleCondition::className(), ['grule_id' => 'id']);
    }

    public function getGruleName($id)
    {
        $name = '';
        $name = Grule::find()->where(['id' => $id])->one();
        return  $name->name;   
    }

    public function getCount()
    {
      return  Grule::find()->where(['knowlegebase_id' => \Yii::$app->session['KnowlegebaseID']])->count();
    }

    public function newName() 
    {
        return "Шаблон_правила-G00"  . (string)(self::getCount()+1); 
    }
   
    public function newUin() 
    {
        return 'G00' . (string)(self::getCount()+1);  
    }

    public function beforeSave($insert)
	{
		if (parent::beforeValidate($insert)) {
            $this->shortname =  Yii::$app->utils->transliteration($this->name);
            $this->knowlegebase_id = \Yii::$app->session['KnowlegebaseID'];
            \Yii::$app->session['GruleID'] =  $this->id;
			return true;
		}  
		return false;		
    }
}
