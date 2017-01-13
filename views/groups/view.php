<?php

use app\helpers\Html;
use yii\grid\GridView;
use macgyer\yii2materializecss\widgets\form\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '群組管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="groups-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::updateButton(['update', 'id' => $model->id]) ?>
        <?= Html::deleteButton(['delete', 'id' => $model->id]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'perm',
            [
                'format' => 'raw',
                'value' => function($model, $key, $index, $widget){
                    return Html::deleteButton(['delete-perms', 'group_id' => $model->group_id, 'perm' => $model->perm]);
                }
            ]
        ],
    ]); ?>

<div class="group-perms-form">

    <?php $form = ActiveForm::begin(['action' => ['view', 'id' => $model->id]]); ?>

    <?= $form->field($permmodel, 'perm')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::createSubmit() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
