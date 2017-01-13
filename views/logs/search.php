<?php

use app\helpers\Html;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\LogsSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = '搜尋';
$this->params['breadcrumbs'][] = ['label' => '系統紀錄', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'ip') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'action') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::updateSubmit('搜尋') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
