<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule".
 *
 * @property int $id
 * @property string $uin
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $knowlegebase_id
 * @property int $grule_id
 *
 * @property Grule $grule
 * @property Knowlegebase $knowlegebase
 * @property RuleTemplate[] $ruleTemplates
 */
class Rule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'grule_id'], 'required'],
            [['knowlegebase_id', 'grule_id'], 'integer'],
            [['uin'], 'string', 'max' => 7],
            [['name', 'shortname'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['grule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grule::className(), 'targetAttribute' => ['grule_id' => 'id']],
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
            'grule_id' => 'Шаблон правила',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrule()
    {
        return $this->hasOne(Grule::className(), ['id' => 'grule_id']);
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
    public function getRuleTemplates()
    {
        return $this->hasMany(RuleTemplate::className(), ['rule_id' => 'id']);
    }
    
    public function getAllSlotName($id) {

        $slots = RuleSlot::find()->where(['ruletemplate_id' => $id])->all();
        $ret ="";
        if (!$slots) return "У начального факта  нет слотов";
        foreach($slots as $slot) 
            $ret .="<p>{$slot['name']} / <a href='/index.php?r=rule-slot/update&id={$slot->id}'>{$slot['datavalue']}</a></p>";
            
        return $ret;
    }

    public function getRuleName($id)
    {
        $name = '';
        $name = Rule::find()->where(['id' => $id])->one();
        return  $name->name;   
    }

    public function getCount()
    {
      return  Rule::find()->where(['knowlegebase_id' => \Yii::$app->session['KnowlegebaseID']])->count();
    }

    public function newUin() 
    {
        return 'R00' . (string)(self::getCount()+1);  
    }

    public function beforeSave($insert)
	{
		if (parent::beforeValidate($insert)) {
            $this->shortname =  Yii::$app->utils->transliteration($this->name);
            $this->knowlegebase_id = \Yii::$app->session['KnowlegebaseID'];
            \Yii::$app->session['RuleID'] =  $this->id;
			return true;
		}  
		return false;		
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
       
       if ($insert) {    
            $GruleTemplate = GruleTemplate::find()->where(['grule_id' => $this->grule_id])->all();
            foreach($GruleTemplate as $GTemplate) {
                $RuleTemplate = new RuleTemplate();
                $RuleTemplate['type'] = $GTemplate['type'];
                $RuleTemplate['template_id'] = $GTemplate['template_id'];       
                $RuleTemplate['rule_id'] = $this->id;
                $RuleTemplate->save();   
                //накидывам слоты
                $TemplateSlot = TemplateSlot::find()->where(['template_id' => $GTemplate['template_id']])->all();
                foreach($TemplateSlot as $slot){
                    $RuleSlot = new RuleSlot(); 
                    $RuleSlot->name = $slot->name;
                    $RuleSlot->shortname = $slot->shortname;
                    $RuleSlot->datatype = $slot->datatype;
                    //разбор на части datavalue
                    if (stripos($slot->datavalue, ";") !== false) {
                        $value = explode(";", $slot->datavalue);
                        $RuleSlot->datavalue = $value[0];
                    }
                    else     
                        $RuleSlot->datavalue = $slot->datavalue;

                    $RuleSlot->vardatavalue  = $slot->datavalue;
                    $RuleSlot->ruletemplate_id = $RuleTemplate->id;
                    $RuleSlot->save();
                }
            }    
        }
    }
}
