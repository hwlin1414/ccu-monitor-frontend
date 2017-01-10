<?php

use app\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '群組管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="groups-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="groups-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::updateSubmit() ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
