<?php

use yii\helpers\Html;
use app\models\Grule;
use app\models\GruleTemplate;

/* @var $this yii\web\View */
/* @var $model app\models\GruleTemplate */

$this->title = 'Новое условие ' . GruleTemplate::getTypeName($model->type);
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны для правил', 'url' => ['/grule']];
$this->params['breadcrumbs'][] = ['label' => Grule::getGruleName($model->grule_id), 'url' => ['/grule/view', 'id' => $model->grule_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grule-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
