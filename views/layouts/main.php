<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$this->registerCss("
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

$this->registerJs(" $('.button-collapse').sideNav();");

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
    <ul id="slide-out" class="side-nav fixed">
        <li>
            <div class="userView">
                <div class="background">
                    <?= Html::img('@web/images/office.jpg', ['width' => 300]) ?>
                </div>
            </div>
        </li>
        <li><?= Html::a(Yii::t('yii', 'Home'), ['/site/index'], ['class' => 'waves-effect']) ?></li>
        <li><?= Html::a('說明', ['/site/about'], ['class' => 'waves-effect']) ?></li>
        <li><div class="divider"></div></li>
        <?php
            if(Yii::$app->user->isGuest){
                echo Html::a('登入', ['/site/login'], ['class' => 'waves-effect']);
            }else{
                echo '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link waves-effect logout']
                )
                . Html::endForm()
                . '</li>';

            }
        ?>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

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
