<?php

use app\models\Groups;
use app\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use macgyer\yii2materializecss\widgets\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = '修改帳號';
$this->params['breadcrumbs'][] = ['label' => '帳號管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->registerJs("$('select').material_select();");
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <div class="users-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

        <?= $form->field($model, 'password', ['enableClientValidation' => false])->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'group_id', [])->dropDownList(
            ArrayHelper::map(Groups::find()->all(), 'id', 'name'),
            ['prompt' => '請選擇一個群組']
        ) ?>

        <div class="row">
            <?= $form->field($model, 'enabled', [
                'template' => "<div class=\"col s4\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() ?>

            <?= $form->field($model, 'verified', [
                'template' => "<div class=\"col s4\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() ?>
        </div>

        <div class="form-group">

            <?= Html::updateSubmit() ?>

        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
