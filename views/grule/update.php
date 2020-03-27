<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grule */

$this->title = 'Редактирование шаблона правил: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны правил', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="grule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
