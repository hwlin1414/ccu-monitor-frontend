<?php

use app\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '帳號管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::updateButton(['update', 'name' => $model->name]) ?>
        <?= Html::deleteButton(['delete', 'name' => $model->name]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'group_id',
                'value' => Html::encode($model->group->name),
            ],
            'enabled:boolean',
            'verified:boolean',
            'registedip',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
