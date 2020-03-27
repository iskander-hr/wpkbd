<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Knowlegebase;
use app\models\Grule;
/* @var $this yii\web\View */
/* @var $model app\models\Rule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'knowlegebase_id')->textInput(['value'=>Knowlegebase::getKnowlegebaseName(\Yii::$app->session['KnowlegebaseID']),'disabled'=>'disable']) ?>

    <?= $form->field($model, 'uin')->textInput(['maxlength' => true,'disabled'=>'disable']) ?>

    <?= $form->field($model,'grule_id')->dropDownList(
                    ArrayHelper::map(Grule::find()->where(['knowlegebase_id'=>Yii::$app->session['KnowlegebaseID']])->all(), 'id', 'name'),
                    ['class'=>'form-control','prompt'=>'']);   
    ?>   

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
   

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// регистрируем небольшой js-код в view-шаблоне
$script = <<< JS
$("#rule-grule_id").change(function() {
    var text = $('#rule-grule_id option:selected').text();
     $('#rule-name').val(text);
});

JS;
$position = $this::POS_READY;
$this->registerJs($script, $position);
?>
