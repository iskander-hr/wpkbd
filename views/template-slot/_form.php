<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Template;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateSlot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-slot-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'template_id')->textInput(['value'=>Template::getTemplateName($model->template_id),'disabled'=>'disable']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datatype')->dropdownList([1 => 'Строка',2 => 'Число']); ?>
   
    <?= $form->field($model, 'datavalue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['template/view', 'id' => $model->template_id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
