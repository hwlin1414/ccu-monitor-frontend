<?php

use app\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '個人資料';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-self">

    <div class="row">
    <div class="col-lg-6">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'group_id',
                'value' => Html::encode($model->group->name),
            ],
            'registedip',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <div class="users-form row">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'password', [
            'enableClientValidation' => false,
            'template' => "<div class=\"col s8\">{input} {label} {error}</div>\n",
        ])->passwordInput(['maxlength' => true, 'autofocus' => true]) ?>

        <div class="form-group">

            <?= Html::updateSubmit() ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

    </div>

    <div class="col-lg-6">

    <h4>使用紀錄</h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            'description',
            'created_at',
        ],
    ]); ?>

    </div>
    </div>

</div>
