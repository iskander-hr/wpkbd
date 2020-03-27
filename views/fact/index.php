<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Fact;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Начальные факты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fact-index">
<h1>
    <?= Html::encode($this->title) ?> 
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>       
</h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid)  {
            if($model->id == Yii::$app->session['FactID']) {
                 return ['style' => 'background-color:#CCC;'];
            }
        },
        'columns' => [
            'uin',
            'name',          
            'description',
            [    
                'label' => 'Слот/значение',
                'format' => 'raw',
                'value' => function ($data) {
                    return  Fact::getAllSlotName($data->id);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
