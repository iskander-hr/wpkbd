<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\UploadFile;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Базы знаний';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="knowlegebase-index">

<h1>
    <?= Html::encode($this->title) ?> 
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Загрузить', ['import'], ['class' => 'btn btn-primary']) ?>     
</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid)  {
            if($model->id == \Yii::$app->session['KnowlegebaseID']) {
                return ['style' => 'background-color:#CCC;'];
            }
        },
        'columns' => [
            'uin',
            'name',            
            'description',
            'author',
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'format' => ['date', 'php:d.m.Y']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '180'],
                'template' => '{view} {update} {delete} {choose} {ekb} {clips}',
                    'buttons' => [
                        'choose' => function ($url,$model) {
                            return Html::a('<span class="glyphicon glyphicon-screenshot"></span>',  $url);
                        },
                        'clips' => function ($url,$model) {
                            return Html::a('<b>CLIPS</b>',   $url);
                        },
                        'ekb' => function ($url,$model) {
                            return Html::a('<b>EKB</b>',  $url);
                        },               
                    ],
            ],
        ],
    ]); ?>


</div>
