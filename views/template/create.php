<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Template */

$this->title = 'Новый шаблон для фактов';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны для фактов', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавление шаблона для факта';
?>
<div class="template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
