<?php

use app\models\Groups;
use app\helpers\Html;
use yii\helpers\ArrayHelper;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = '修改帳號';
$this->params['breadcrumbs'][] = ['label' => '帳號管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';

$this->registerJs("$('select').material_select();");
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="users-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'group_id', [])->dropDownList(
            ArrayHelper::map(Groups::find()->all(), 'id', 'name')
        ) ?>

        <?= $form->field($model, 'enabled')->textInput() ?>

        <?= $form->field($model, 'verified')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
