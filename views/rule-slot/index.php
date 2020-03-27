<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слоты правил';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-slot-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
           

            'id',
            'name',
            //'shortname',
            //'datatype',
            'datavalue',
            //'vardatavalue',
            //'ruletemplate_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
