<?php

use app\helpers\Html;
use app\models\Groups;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '帳號管理';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("$('select').material_select();");
?>
<div class="users-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            $class = "";
            if($model->enabled == 0){
                $class = "grey lighten-2";
            }else if($model->verified == 0){
                $class = "amber lighten-4";
            }
            return ['class' => $class];
        },
        'columns' => [
            'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::a(Html::encode($model->name), ['update', 'name' => $model->name]);
                },
            ],
            [
                'attribute' => 'group_id',
                'format' => 'raw',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'group_id',
                    ArrayHelper::map(Groups::find()->all(), 'id', 'name'),
                    ['class'=>'input-field','prompt' => '']
                ),
                'value' => function($model, $key, $index, $widget){
                    $group = $model->group;
                    return Html::a(Html::encode($group->name), ['/groups/view', 'id' => $group->id]);
                },
            ],
            'enabled:boolean',
            'verified:boolean',
            'registedip',
            'created_at',
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::deleteButton(['delete', 'name' => $model->name]);
                },
            ],
        ],
    ]); ?>

    <p>
        <?= Html::createButton() ?>
    </p>
</div>
