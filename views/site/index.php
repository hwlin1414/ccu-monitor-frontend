<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>校園設備監控系統</h1>

        <p class="lead">歡迎來到校園設備監控系統</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h4>深入了解</h4>

                <p>本系統由CNA提供，用來測試校園網路、網站、設備是否正常運作，並會在發現問題後進行email通知。</p>
            </div>
            <div class="col-lg-6">
                <h4>關於系統</h4>

                <p>
                    本系統由以下軟體構成：
                    <ul>
                        <li><?= Html::a('FreeBSD', 'https://www.freebsd.org/', ['target' => '_blank']) ?></li>
                        <li><?= Html::a('Nagios Core', 'https://www.nagios.org/', ['target' => '_blank']) ?></li>
                        <li><?= Html::a('Nginx', 'https://nginx.org/', ['target' => '_blank']) ?></li>
                        <li><?= Html::a('PHP', 'http://www.php.net/', ['target' => '_blank']) ?></li>
                        <li><?= Html::a('MariaDB', 'https://mariadb.org/', ['target' => '_blank']) ?></li>
                        <li><?= Html::a('Redis', 'https://redis.io/', ['target' => '_blank']) ?></li>
                        <li><?= Html::a('Yii Framework', 'http://www.yiiframework.com/', ['target' => '_blank']) ?></li>
                    </ul>
                </p>
            </div>
        </div>

    </div>
</div>
