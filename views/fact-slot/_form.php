<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Fact;
/* @var $this yii\web\View */
/* @var $model app\models\FactSlot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fact-slot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fact_id')->textInput(['value'=>Fact::getFactName($model->fact_id),'disabled'=>'disable']) ?>
   
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled'=>'disable']) ?>

    <?= $form->field($model, 'datatype')->dropdownList([1 => 'Строка',2 => 'Число'],['disabled'=>'disable']); ?>

    <?php if (stripos($model->vardatavalue, ";") !== false) : ?>
    <div class="form-group field-factslot-vardatatype">
        <label class="control-label" for="factslot-vardatatype"> Возможные значения</label>
        <select id="factslot-vardatatype" class="form-control" name="FactSlot[vardatatype]">
            <?php
                $value = explode(";", $model->vardatavalue);
                foreach($value as $val) echo "<option value='{$val}'>{$val}</option>";
            ?>
        </select>
    </div> 
    <?php endif ?>    

    <?= $form->field($model, 'datavalue')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['fact/view', 'id' => $model->fact_id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
// регистрируем небольшой js-код в view-шаблоне
$script = <<< JS
$("#factslot-vardatatype").change(function() {
    var text = $('#factslot-vardatatype option:selected').text();
     $('#factslot-datavalue').val(text);
});

JS;
$position = $this::POS_READY;
$this->registerJs($script, $position);
?>