<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateSlot */

$this->title = 'Редактирование слота шаблона: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['/template']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="template-slot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
