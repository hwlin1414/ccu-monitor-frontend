<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HostContact */

$this->title = 'Create Host Contact';
$this->params['breadcrumbs'][] = ['label' => 'Host Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="host-contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
