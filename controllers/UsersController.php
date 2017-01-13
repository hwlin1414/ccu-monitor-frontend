<?php

namespace app\controllers;

use Yii;
use app\filters\AccessControl;
use app\helpers\ModelHelper;
use app\models\Users;
use app\models\search\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['created_at' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        $model->enabled = 1;
        $model->verified = 1;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password);
            $model->registedip = Yii::$app->request->userIp;

            if($model->save()){
                $diff = ModelHelper::compare($model, new Users(), ['enabled', 'verified']);
                $diff = json_encode($diff);

                yii::warning("新增使用者({$model->id}): {$model->name} {$diff}", 'app\users\create');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldModel = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at = date('Y-m-d H:i:s');
            if($model->password === ""){
                $model->password = $oldModel->password;
            }else{
                $model->setPassword($model->password);
            }

            if($model->save()){
                $diff = ModelHelper::compare($model, $oldModel, ['name', 'enabled', 'verified', 'password']);
                if(isset($diff['password'])) $diff['password'] = "changed";
                $diff = json_encode($diff);

                yii::warning("更新使用者({$model->id}): {$model->name} {$diff}", 'app\users\update');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $model->password = '';
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        yii::warning("刪除使用者({$model->id}): {$model->name} (enabled: {$model->enabled}, verified: {$model->verified})", 'app\users\delete');
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
