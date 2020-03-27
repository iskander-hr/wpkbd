<?php

namespace app\controllers;

use Yii;
use app\models\Rule;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\RuleTemplate;
/**
 * RuleController implements the CRUD actions for Rule model.
 */
class RuleController extends Controller
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
     * Lists all Rule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Rule::find()->where(['knowlegebase_id' => Yii::$app->session['KnowlegebaseID']]);        
        $dataProvider = new ActiveDataProvider([
            'query' =>  $query,
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        \Yii::$app->session['RuleID'] = $id;    
        $this->storeReturnUrl();
        
        $model = Rule::findOne($id); 
        
        $query = RuleTemplate::find()->where(['rule_id' => $id,'type' => 1]);  
        $dataProvider1 = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query = RuleTemplate::find()->where(['rule_id' => $id,'type' => 2]);  
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
     * Creates a new Rule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Rule();
        $model->uin = Rule::newUin();
        //$model->name = Rule::newName();
        $model->description = 'Описание для правила:';    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rule model.
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
     * Deletes an existing Rule model.
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
     * Finds the Rule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function storeReturnUrl()
    {
        Yii::$app->user->returnUrl = Yii::$app->request->url;
    }
}
