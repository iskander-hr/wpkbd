<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Grule;
use app\models\GruleTemplate;
use app\models\Template;
/* @var $this yii\web\View */
/* @var $model app\models\GruleTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grule-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grule_id')->textInput(['maxlength' => true, 'value'=>Grule::getGruleName($model->grule_id),'disabled'=>'disable']) ?>

    <?= $form->field($model, 'template_id')->dropDownList(
            ArrayHelper::map(Template::find()->where(['knowlegebase_id' =>\Yii::$app->session['KnowlegebaseID']])->all(), 'id', 'name')); 
    ?> 

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена',  Yii::$app->request->referrer, ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
