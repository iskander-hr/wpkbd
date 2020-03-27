<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Правила';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-index">
<h1>
    <?= Html::encode($this->title) ?> 
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>       
</h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid)  {
            if($model->id == Yii::$app->session['RuleID']) {
                 return ['style' => 'background-color:#CCC;'];
            }
        },
        'columns' => [
            'uin',
            'name',
            'description',
            //'knowlegebase_id',
            //'grule_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
