<?php

namespace app\controllers;

use Yii;
use app\models\Knowlegebase;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImportForm;
use yii\web\UploadedFile;

/**
 * KnowlegebaseController implements the CRUD actions for Knowlegebase model.
 */
class KnowlegebaseController extends Controller
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
     * Lists all Knowlegebase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Knowlegebase::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Knowlegebase model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->session['KnowlegebaseID']  = $id;
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Knowlegebase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Knowlegebase();
        
        $model->uin = Knowlegebase::newUin();
        $model->name = Knowlegebase::newName();
        $model->created_at = time();
        $model->updated_at = time();
        $model->description = 'Описание для базы знаний:';    

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session['KnowlegebaseID']  = $model->id;
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Knowlegebase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session['KnowlegebaseID']  = $id;
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Knowlegebase model.
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

    public function actionChoose($id)
    {
        Yii::$app->session['KnowlegebaseID'] = $this->findModel($id)->id;        
        return $this->redirect(['index']);
    }

    public function actionEkb($id) {
       
        $model = $this->findModel($id);
        $model->gen_code = Yii::$app->ekbGenerator->generateEKBCode($model);

        //Запись в файл
        $path = \Yii::getAlias('@data') ;
        array_map('unlink', glob($path . '/*.ekb')); //отчистить папку data

        $filename = $path . '/' . $model->shortname . '.ekb';
        Yii::$app->session['filename'] = $filename;  //запись имени файла в сессию
        $file = fopen( $filename, "w" );
        
        if( $file == false ) {
            echo ( "Error in opening new file" );
            exit();
        }
        fwrite( $file, $model->gen_code);
        fclose( $file );     

        return $this->render('ekb', [
            'model' => $model,
        ]);
    }

    
    public function actionDownload($id) {

       $model = $this->findModel($id); 
   
       if(Yii::$app->session['filename'] !== null) {
       $filename = Yii::$app->session['filename'];
 
        if (file_exists($filename)) {
            return \Yii::$app->response->sendFile($filename);
           
        } 
        throw new \Exception('File not found');
     }
    }



    public function actionClips($id) {

        $model = $this->findModel($id);
        $model->gen_code = Yii::$app->clipsGenerator->generateCLIPSCode($model);

         //Запись в файл
         $path = \Yii::getAlias('@data') ;
         array_map('unlink', glob($path . '/*.clp')); //отчистить папку data

         $filename = $path . '/' . $model->shortname . '.clp';
         Yii::$app->session['filename'] = $filename;  //запись имени файла в сессию
         $file = fopen( $filename, "w" );
         
         if( $file == false ) {
             echo ( "Error in opening new file" );
             exit();
         }
         fwrite( $file, $model->gen_code);
         fclose( $file );     

        return $this->render('clips', [
            'model' => $model,
            
        ]);
    }
public function actionRunclips($id) {
    $model = $this->findModel($id); 
    
    $path_src = \Yii::getAlias('@data');
    $fname = $model->shortname;

    $file_clp = $fname . ".clp";
    $file_run = $fname . ".run";
    $file_rez = $fname . ".rez";

     
    if (file_exists($path_src . "/" . $file_clp)) {              
       if (!copy($path_src . "/" . $file_clp, $file_clp)) {
            echo "не удалось скопировать $file_clp...\n";
            exit();
        }

    $current = "(clear)\n"
              ."(load* " . $file_clp . ")\n"
		      ."(reset)\n"
		      ."(dribble-on " . $file_rez .")\n"
		      ."(watch facts)\n"
		      ."(watch rules)\n"
		      ."(run)\n"
		      ."(dribble-off)\n"
		      ."(exit)\n";
            
        file_put_contents($file_run, $current);             
    }
     sleep(2);

    if (file_exists($file_run)) {    
        $handle = popen("./clips -f2 " . $file_run, 'r');
        
      	//exec("./clips -f2 " . $file_run); 
        //system("./clips -f2 " . $file_run);
        sleep(2);  //Ну уж извините за тоое албано-неасинхронное решение
        return $this->render('clips_rez', [
            'model' => $model,
        ]);        
    }    

    return $this->redirect(['index']);
}    
    public function actionImport() 
    {
        // Yii::$app->ekbImport->EKBtoDB('../data/sample5.ekb');
        // return $this->redirect(['/knowlegebase']);
        
        
        $model = new ImportForm();

        if (Yii::$app->request->isPost) {
            $model->ekbFile = UploadedFile::getInstance($model, 'ekbFile');
            if ($model->upload()) {
                // file is uploaded successfully
                Yii::$app->ekbImport->EKBtoDB('../data/' . $model->ekbFile);
                return $this->redirect(['/knowlegebase']);
            }
        }

        return $this->render('import', ['model' => $model]);
    }


    /**
     * Finds the Knowlegebase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Knowlegebase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Knowlegebase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
