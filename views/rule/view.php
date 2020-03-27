<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Knowlegebase;
use app\models\Template;
use app\models\Rule;
/* @var $this yii\web\View */
/* @var $model app\models\Rule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Правила', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rule-view">
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
    <h2>Условия ЕСЛИ  </h2>

<?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'layout'=>"{items}",
        'columns' => [
            [    
                'attribute' => 'template_id',
                'label' => 'Шаблоны',
                'value' => function ($data) {
                    return Template::getTemplateName($data->template_id);
                },
            ],
            [    
                'label' => 'Слот/значение',
                'format' => 'raw',
                'value' => function ($data) {
                    return  Rule::getAllSlotName($data->id);
                },
            ],
            /*[
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'fact-slot',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '50px'],
                'template' => '{update}',
            ],*/
        ],
    ]); ?>
    <!-- Блок ЕСЛИ -->
    </div>
    <div class="col-md-6">
    <!-- Блок  ТО -->
     
    

<h2>Условия ТО  </h2>

<?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'layout'=>"{items}",
        'columns' => [
            [    
                'attribute' => 'template_id',
                'label' => 'Шаблоны',
                'value' => function ($data) {
                    return Template::getTemplateName($data->template_id);
                },
            ], 
            [    
                'label' => 'Слот/значение',
                'format' => 'raw',
                'value' => function ($data) {
                    return Rule::getAllSlotName($data->id);
                },
            ],
            /*[
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'fact-slot',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '50px'],
                'template' => '{update}',
            ],*/
        ],
    ]); ?>       
    <!-- Блок  ТО -->      
    </div>
</div>



</div>

