<?php

use app\helpers\Html;
use macgyer\yii2materializecss\widgets\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\GlobalConfig */

$this->title = '新增設定';
$this->params['breadcrumbs'][] = ['label' => '系統設定', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="global-config-create">

    <h3><?= Html::encode($this->title) ?></h3>

<div class="global-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::createSubmit() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
