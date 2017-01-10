<?php

namespace app\controllers;

use Yii;
use app\filters\AccessControl;
use app\models\Groups;
use app\models\GroupPerms;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupsController implements the CRUD actions for Groups model.
 */
class GroupsController extends Controller
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
     * Lists all Groups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Groups::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Groups model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $permmodel = new GroupPerms();
        if ($permmodel->load(Yii::$app->request->post())){
            $permmodel->group_id = $id;
            if($permmodel->save()){
                Yii::warning("新增群組權限({$model->id}): {$model->name} -> \"{$permmodel->perm}\"", 'app\groups\view');

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => GroupPerms::find()->where(['group_id' => $id]),
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'permmodel' => $permmodel,
        ]);
    }

    /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Groups();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::warning("新增群組({$model->id}): {$model->name}", 'app\groups\view');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Groups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $name = $model->name;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::warning("修改群組({$model->id}): {$name} -> {$model->name}", 'app\groups\view');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Groups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        Yii::warning("刪除群組({$model->id}): {$model->name}", 'app\groups\view');

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing GroupPerms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $group_id
     * @param string $perm
     * @return mixed
     */
    public function actionDeletePerms($group_id, $perm)
    {
        $model = $this->findModel($group_id);

        $permmodel = GroupPerms::findOne(['group_id' => $group_id, 'perm' => $perm]);
        if(is_null($permmodel)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        Yii::warning("刪除群組權限({$model->id}): {$model->name} -> \"{$permmodel->perm}\"", 'app\groups\view');
        $permmodel->delete();

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Groups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Groups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
