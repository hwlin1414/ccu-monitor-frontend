<?php

use app\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '群組管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            #['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a(Html::encode($model->name), ['/groups/view', 'id' => $model->id]);
                }
            ],
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::deleteButton(['delete', 'id' => $model->id]);
                }
            ]
            #['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::createButton() ?>
    </p>
</div>
