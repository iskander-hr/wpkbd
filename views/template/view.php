<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Knowlegebase;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Template */

$this->title = '[' . $model->uin . '] - '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны для фактов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="template-view">
<h1>
    <?= Html::encode($this->title) ?>

    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
           'class' => 'btn btn-danger',
           'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
    ]) ?>

</h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uin',
            'name',
            'shortname',
            'description',
            [    
                'attribute' => 'knowlegebase_id',
                'label' => 'База знаний',
                'value' => function ($data) {
                    return Knowlegebase::getKnowlegebaseName($data->knowlegebase_id);
                },
            ],
        ],
    ]) ?>

<h2>Слоты шаблона: <?= $this->title ?> <?= Html::a('Добавить', ['/template-slot/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> </h2>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}",
        'columns' => [
            'name',
            'datavalue',
            [    
                'format' => 'raw',
                'headerOptions' => ['width' => '50px'],
                'attribute' => 'datatype',
                'label' => 'Тип',
                'value' => function ($data) {
                    return ($data->datatype == 1 ? '<span class="label label-success">STR</span>':'<span class="label label-warning">NUM</span>');
                },
            ],
            'description',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'template-slot',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '180'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
