<?php

namespace app\controllers;

use Yii;
use app\models\GroupPerms;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupPermsController implements the CRUD actions for GroupPerms model.
 */
class GroupPermsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all GroupPerms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GroupPerms::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupPerms model.
     * @param integer $group_id
     * @param string $perm
     * @return mixed
     */
    public function actionView($group_id, $perm)
    {
        return $this->render('view', [
            'model' => $this->findModel($group_id, $perm),
        ]);
    }

    /**
     * Creates a new GroupPerms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GroupPerms();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'group_id' => $model->group_id, 'perm' => $model->perm]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GroupPerms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $group_id
     * @param string $perm
     * @return mixed
     */
    public function actionUpdate($group_id, $perm)
    {
        $model = $this->findModel($group_id, $perm);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'group_id' => $model->group_id, 'perm' => $model->perm]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GroupPerms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $group_id
     * @param string $perm
     * @return mixed
     */
    public function actionDelete($group_id, $perm)
    {
        $this->findModel($group_id, $perm)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupPerms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $group_id
     * @param string $perm
     * @return GroupPerms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($group_id, $perm)
    {
        if (($model = GroupPerms::findOne(['group_id' => $group_id, 'perm' => $perm])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
