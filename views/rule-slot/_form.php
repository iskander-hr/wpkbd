<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RuleSlot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rule-slot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled'=>'disable']) ?>

    <?= $form->field($model, 'datatype')->dropdownList([1 => 'Строка',2 => 'Число'],['disabled'=>'disable']); ?>

    <?php if (stripos($model->vardatavalue, ";") !== false) : ?>
    <div class="form-group field-ruleslot-vardatatype">
        <label class="control-label" for="ruleslot-vardatatype"> Возможные значения</label>
        <select id="ruleslot-vardatatype" class="form-control" name="RuleSlot[vardatatype]">
            <?php
                $value = explode(";", $model->vardatavalue);
                foreach($value as $val) echo "<option value='{$val}'>{$val}</option>";
            ?>
        </select>
    </div> 
    <?php endif ?>   

    <?= $form->field($model, 'datavalue')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отмена', ['/rule'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// регистрируем небольшой js-код в view-шаблоне
$script = <<< JS
$("#ruleslot-vardatatype").change(function() {
    var text = $('#ruleslot-vardatatype option:selected').text();
     $('#ruleslot-datavalue').val(text);
});

JS;
$position = $this::POS_READY;
$this->registerJs($script, $position);
?>