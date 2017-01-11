<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use macgyer\yii2materializecss\widgets\Nav;
use macgyer\yii2materializecss\widgets\SideNav;

AppAsset::register($this);

$this->registerCss("
    .side-nav {
        width: 240px;
    }
    .side-nav a {
        font-size: 16px;
    }
    @media only screen and (min-width : 992px) {
        .footer {
            margin-left: 240px;
        }
        .wrap2 > .container {
            padding-top: 0px;
            width: 90%;
        }
        .wrap2{
            padding-left: 250px;
        }
    }
");

#$this->registerJs("$('.button-collapse').sideNav();");

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

<?php
$items = [
    '<li>' . Html::img('@web/images/office.jpg', ['width' => 240]) . '</li>',
    ['label' => Yii::t('yii', 'Home'), 'url' => ['/site/index'], 'linkOptions' => ['class' => 'waves-effect']],
    ['label' => '說明', 'url' => ['/site/about'], 'linkOptions' => ['class' => 'waves-effect']],
    '<li><div class="divider"></div></li>',
    [
        'label' => '登入',
        'url' => ['/site/login'],
        'linkOptions' => ['class' => 'waves-effect'],
        'visible' => Yii::$app->user->isGuest,
    ]
];
if(!Yii::$app->user->isGuest){
    $items[] = ['label' => '通知設定', 'url' => ['/contacts/index'], 'linkOptions' => ['class' => 'waves-effect']];
    $items[] = ['label' => '主機設定', 'url' => ['/hosts/index'], 'linkOptions' => ['class' => 'waves-effect']];
    $items[] = '<li><div class="divider"></div></li>';
    if(Yii::$app->user->identity->hasPermission('layout', 'management')){
        $items[] = '<ul class="collapsible collapsible-accordion"><li>';
        $items[] = '<a class="collapsible-header">系統管理</a>';
        $items[] = '<div class="collapsible-body"><ul>';
        $items[] = ['label' => '帳號管理', 'url' => ['/users/index'], 'linkOptions' => ['class' => 'waves-effect']];
        $items[] = ['label' => '群組管理', 'url' => ['/groups/index'], 'linkOptions' => ['class' => 'waves-effect']];
        $items[] = ['label' => '系統設定', 'url' => ['/global-config/index'], 'linkOptions' => ['class' => 'waves-effect']];
        $items[] = ['label' => '系統紀錄', 'url' => ['/logs/index'], 'linkOptions' => ['class' => 'waves-effect']];
        $items[] = '</ul></div>';
        $items[] = '</li></ul>';

        $items[] = '<li><div class="divider"></div></li>';
    }
    $items[] = ['label' => '個人資料', 'url' => ['/users/self'], 'linkOptions' => ['class' => 'waves-effect']];
    $items[] = [
        'label' => '登出 (' . Yii::$app->user->identity->name . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['class' => 'waves-effect logout', 'data-method' => 'POST'],
    ];
}

echo SideNav::widget([
    'options' => ['class' => 'fixed'],
    //'clientOptions' => ['menuWidth' => 240],
    'items' => $items,
]);

?>

    <div class="wrap2">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Campus Network Association <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
