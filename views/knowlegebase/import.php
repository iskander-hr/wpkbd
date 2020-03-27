<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;


$this->title = 'Еагрузка  EKB-файла';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">

    <h1><?= Html::encode($this->title) ?></h1>

</div>

<div class="template-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'ekbFile')->fileInput(['class'=>'form-control']) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Загрузить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> 