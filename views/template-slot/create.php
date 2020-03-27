<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateSlot */

$this->title = 'Новый слот';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['/template']];
$this->params['breadcrumbs'][] = 'Добавление слота шаблона';
?>
<div class="template-slot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
