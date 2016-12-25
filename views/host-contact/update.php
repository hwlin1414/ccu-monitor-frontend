<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HostContact */

$this->title = 'Update Host Contact: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Host Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="host-contact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
