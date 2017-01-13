<?php

use app\helpers\Html;
use macgyer\yii2materializecss\widgets\form\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = '新增群組';
$this->params['breadcrumbs'][] = ['label' => '群組管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <h3><?= Html::encode($this->title) ?></h3>

<div class="groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

        <?= Html::createSubmit() ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
