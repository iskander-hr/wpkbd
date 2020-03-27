<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fact */

$this->title = 'Новый начальный факт';
$this->params['breadcrumbs'][] = ['label' => 'Начальные факты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
