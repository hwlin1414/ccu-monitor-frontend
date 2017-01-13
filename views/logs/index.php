<?php

use app\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系統紀錄';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            $class = "";
            switch($model->level){
                case 'error':
                    $class = "deep-orange lighten-4";
                    break;
                case 'warning':
                    $class = "amber lighten-4";
                    break;
            }
            return ['class' => $class];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ip',
            'level',
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                'value' => function($model, $key, $index, $widget){
                    if(is_null($model->user)) return null;
                    return Html::a(Html::encode($model->user->name), ['/users/view', 'id' => $model->user_id]);
                },
            ],
            'action',
            'description',
            'created_at',
        ],
    ]); ?>

    <p>
        <?= Html::updateButton(['search'], '搜尋') ?>
    </p>
</div>
