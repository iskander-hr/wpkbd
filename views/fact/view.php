<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Knowlegebase;
use app\models\Template;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Fact */

$this->title = '[' . $model->uin . '] - '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Начальные факты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fact-view">
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
                'attribute' => 'template_id',
                'label' => 'Шаблон',
                'value' => function ($data) {
                    return Template::getTemplateName($data->template_id);
                },
            ],
            [    
                'attribute' => 'knowlegebase_id',
                'label' => 'База знаний',
                'value' => function ($data) {
                    return Knowlegebase::getKnowlegebaseName($data->knowlegebase_id);
                },
            ],
        ],
    ]) ?>
</div>


<h2>Слоты для начального факта: <?= $this->title ?> </h2>
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
                'controller' => 'fact-slot',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '50px'],
                'template' => '{update}',
            ],
        ],
    ]); ?>
</div>
