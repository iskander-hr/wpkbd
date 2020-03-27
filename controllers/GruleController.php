<?php

namespace app\controllers;

use Yii;
use app\models\Grule;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\GruleTemplate;

/**
 * GruleController implements the CRUD actions for Grule model.
 */
class GruleController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Grule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Grule::find()->where(['knowlegebase_id' => Yii::$app->session['KnowlegebaseID']]);        
        $dataProvider = new ActiveDataProvider([
            'query' =>  $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        \Yii::$app->session['GruleID'] = $id;        
        $this->storeReturnUrl();
        
        $model = Grule::findOne($id); 
        
        $query = GruleTemplate::find()->where(['grule_id' => $id,'type'=>1]);  
        $dataProvider1 = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query = GruleTemplate::find()->where(['grule_id' => $id,'type'=>2]);  
        $dataProvider2 = new ActiveDataProvider([
            'query' => $query,
        ]);
       
        return $this->render('view', [
            'model' => $model,
            'dataProvider1' => $dataProvider1,
            'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Creates a new Grule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Grule();
        $model->uin = Grule::newUin();
        $model->name = Grule::newName();
        $model->description = 'Описание шаблона правила:'; 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Grule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Grule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Grule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Grule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Grule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function storeReturnUrl()
    {
        Yii::$app->user->returnUrl = Yii::$app->request->url;
    }
}
