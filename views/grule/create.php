<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grule */

$this->title = 'Новый шаблон правила';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны правил', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grule-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
