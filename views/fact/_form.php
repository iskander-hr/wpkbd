<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Knowlegebase;
use app\models\Template;
/* @var $this yii\web\View *
/* @var $model app\models\Fact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'knowlegebase_id')->textInput(['value'=>Knowlegebase::getKnowlegebaseName(\Yii::$app->session['KnowlegebaseID']),'disabled'=>'disable']) ?>

    <?= $form->field($model, 'uin')->textInput(['maxlength' => true,'disabled'=>'disable']) ?>

    <?= $form->field($model,'template_id')->dropDownList(
                    ArrayHelper::map(Template::find()->where(['knowlegebase_id'=>Yii::$app->session['KnowlegebaseID']])->all(), 'id', 'name'),
                    ['class'=>'form-control','prompt'=>'При выборе, значение подставиться в поле Имя']);   
    ?>   

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['/fact'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
// регистрируем небольшой js-код в view-шаблоне
$script = <<< JS
$("#fact-template_id").change(function() {
    var text = $('#fact-template_id option:selected').text();
     $('#fact-name').val(text);
});

JS;
$position = $this::POS_READY;
$this->registerJs($script, $position);
?>
