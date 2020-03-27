<?php

namespace app\controllers;

use Yii;
use app\models\Template;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\TemplateSlot;

/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends Controller
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
     * Lists all Template models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Template::find()->where(['knowlegebase_id' => Yii::$app->session['KnowlegebaseID']]);        
        $dataProvider = new ActiveDataProvider([
            'query' =>  $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    

    /**
     * Displays a single Template model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        \Yii::$app->session['TemplateID'] = $id;        
        $this->storeReturnUrl();
        
        $model = Template::findOne($id); 
        
        $query = TemplateSlot::find()->where(['template_id' => $id]);  
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        
        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    /**
     * Creates a new Template model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Template();
        $model->uin = Template::newUin();
        $model->name = Template::newName();
        $model->description = 'Описание для шаблона:';    
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Template model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        \Yii::$app->session['TemplateID'] = $id; 
        $model = $this->findModel($id);
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
             return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Template model.
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
     * Finds the Template model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Template the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Template::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function storeReturnUrl()
    {
        Yii::$app->user->returnUrl = Yii::$app->request->url;
    }
    
}
