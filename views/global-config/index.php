<?php

use app\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系統設定';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="global-config-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'key',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a(Html::encode($model->key), ['update', 'id' => $model->key]);
                }
            ],
            'value',
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::deleteButton(['delete', 'id' => $model->key]);
                }
            ],
        ],
    ]); ?>

    <p>
        <?= Html::createButton() ?>
    </p>
</div>
