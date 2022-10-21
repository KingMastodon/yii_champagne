<?php

namespace app\controllers;

use app\models\GoalsLog;
use app\models\GoalsLogSearch;
use app\models\GoalsApis;
use app\models\GoalApiProvider;
use Symfony\Component\VarDumper\Cloner\Data;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoalsLogController implements the CRUD actions for GoalsLog model.
 */
class GoalsLogController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all GoalsLog models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GoalsLogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $apisList = GoalsApis::find()->indexBy('id')->select('base_url')->column();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'apisList' => $apisList
        ]);
    }

    /**
     * Displays a single GoalsLog model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GoalsLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GoalsLog();
        $model->created_at = time();
        $model->status = GoalsLog::STATUS_NOT_APPROVED;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GoalsLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GoalsLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GoalsLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return GoalsLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoalsLog::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetApproved($goalId, $apiId)
    {
        $goalsLogModel = GoalsLog::findOne(['id' => $goalId]);
        
        $goalsLogModel->data_provider = $apiId;
        $goalsLogModel->status = GoalsLog::STATUS_APPROVED;
        $goalsLogModel->save();
        $goalsApisModel = GoalsApis::findOne(['id' => $apiId]);
        $goalApiProvider = new GoalApiProvider($goalsApisModel, $goalsLogModel);
        $goalApiProvider->createHttpClientRequest();
        return $this->redirect(['index']);
    }
}
