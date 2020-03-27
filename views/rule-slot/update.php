<?php

use yii\helpers\Html;
//use app\models\Rule;
/* @var $this yii\web\View */
/* @var $model app\models\RuleSlot */

$this->title = 'Редактирование слота: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Правила', 'url' => ['/rule']];
//$this->params['breadcrumbs'][] = ['label' => Rule::getRuleName($model->rule_id), 'url' => ['/rule/view', 'id' => $model->rule_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="rule-slot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
