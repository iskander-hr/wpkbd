<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Knowlegebase;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Grule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны для правил', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="grule-view">
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


<div class="row">
    <div class="col-md-6">
    <!-- Блок ЕСЛИ -->
    <h2>Условия ЕСЛИ <?= Html::a('Добавить', ['/grule-template/create', 'id' => $model->id, 'ca' =>1], ['class' => 'btn btn-primary']) ?> </h2>

<?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'layout'=>"{items}",
        'columns' => [
            [
                'attribute' => 'template_id',
                'label' => 'Шаблон',
                'value' => 'template.name',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'controller' => 'grule-template',
                'header'=>'', 
                'headerOptions' => ['width' => '40'],
                'template' => '{delete}',
            ],
        ],
    ]); ?>
    <!-- Блок ЕСЛИ -->
    </div>
    <div class="col-md-6">
    <!-- Блок  ТО -->
     
    

<h2>Условия ТО <?= Html::a('Добавить', ['/grule-template/create', 'id' => $model->id, 'ca' => 2], ['class' => 'btn btn-primary']) ?> </h2>

<?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'layout'=>"{items}",
        'columns' => [
            [
                'attribute' => 'template_id',
                'label' => 'Шаблон',
                'value' => 'template.name',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'controller' => 'grule-template',
                'header'=>'', 
                'headerOptions' => ['width' => '40'],
                'template' => '{delete}',   
            ],
        ],
    ]); ?>       
    <!-- Блок  ТО -->      
    </div>
</div>



</div>
