<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupPerms */

$this->title = 'Update Group Perms: ' . $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Perms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_id, 'url' => ['view', 'group_id' => $model->group_id, 'perm' => $model->perm]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-perms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
