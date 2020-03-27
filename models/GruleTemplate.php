<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grule_template".
 *
 * @property int $id
 * @property int $type
 * @property int $template_id
 * @property int $grule_id
 *
 * @property Grule $grule
 * @property Template $template
 */
class GruleTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grule_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'template_id', 'grule_id'], 'integer'],
            [['template_id', 'grule_id'], 'required'],
            [['grule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grule::className(), 'targetAttribute' => ['grule_id' => 'id']],
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
            'type' => 'Тип',
            'template_id' => 'Шаблон',
            'grule_id' => 'Шаблон правила',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getgrule()
    {
        return $this->hasOne(Grule::className(), ['id' => 'grule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }
    
    public function getGruleTemplateName($id)
    {
        $name = '';
        $name = GruleTemplate::find()->where(['id' => $id])->one();
        return  $name->name;   
    }
    public function getTypeName($num)
    {
        $typename = array(1 => 'Если', 2 =>'То');
        return $typename[$num];
    }
}
