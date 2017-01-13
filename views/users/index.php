<?php

use app\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '帳號管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'group_id',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    $group = $model->group;
                    return Html::a(Html::encode($group->name), ['/groups/view', 'id' => $group->id]);
                },
            ],
            'enabled:boolean',
            'verified:boolean',
            'registedip',
            'created_at',
        ],
    ]); ?>

    <p>
        <?= Html::createButton() ?>
    </p>
</div>
