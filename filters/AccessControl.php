<?php
namespace app\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter
{

    public function init()
    {
        parent::init();
    }

    public function beforeAction($action)
    {
        $user = Yii::$app->user;

        if($user->isGuest){
            $user->loginRequired();
            return false;
        }

        $controllerId = $action->controller->id;
        $actionId = $action->id;
        if (!$user->identity->hasPermission($controllerId, $actionId)){
            throw new ForbiddenHttpException(Yii::t('yii', '你沒有權限存取!!!'));
            return false;
        }
        return true;
    }
}
