<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Knowlegebase */

$this->title = 'Новая база знаний';
$this->params['breadcrumbs'][] = ['label' => 'Базы знаний', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="knowlegebase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
