<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'gen_code')->textarea(['rows' => 30, 'class' => 'form-control', 'disabled'=>'disable' ])->label('---'); ?>

    <div class="form-group">
        <?= Html::a('Скачать', ['download', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>