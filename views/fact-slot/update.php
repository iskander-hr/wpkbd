<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FactSlot */
$this->title = 'Редактирование слота начального факта: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Начальные факты', 'url' => ['/fact']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="fact-slot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
