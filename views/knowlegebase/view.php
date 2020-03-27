<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Template;
use app\models\Fact;
use app\models\Grule;
use app\models\Rule;
/* @var $this yii\web\View */
/* @var $model app\models\Knowlegebase */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Базы знаний', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="knowlegebase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хочете удалить эту базу знаний?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uin',
            'name',
            'shortname',
            'description',
            'author',
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'format' => ['date', 'php:d.m.Y']
            ],
            [
                'label' => 'Количество шаблонов',
                'value' =>  Template::getCount(),
            ],
            [
                'label' => 'Количество шаблонов правил',
                'value' => Grule::getCount(),
            ],
            [
                'label' => 'Количество начальных фактов',
                'value' => Fact::getCount(),
            ],
            [
                'label' => 'Количество правил',
                'value' => Rule::getCount(),
            ],
            
        ],
    ]) ?>

</div>
