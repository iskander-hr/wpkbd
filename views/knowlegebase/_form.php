<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Knowlegebase;

/* @var $this yii\web\View */
/* @var $model app\models\Knowlegebase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="knowlegebase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uin')->textInput(['maxlength' => true,'disabled'=>'disable']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
