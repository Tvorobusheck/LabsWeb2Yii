<?php

namespace app\controllers;

use Yii;
use app\models\Images;
use app\models\ImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; 

/**
 * ImagesController implements the CRUD actions for Images model.
 */
class ImagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'askdelete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['askdelete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
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
     * Lists all Images models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Images model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
	$model = $this->findModel($id);
	if (substr_count(explode(';', $model->caption)[0],
	   Yii::$app->user->identity['login']) == 0)
		return $this->redirect(['index']);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Images model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Images();

        if ($model->load(Yii::$app->request->post())) {
	   $somefile = UploadedFile::getInstance($model, 'filename');
	   $date = date_create();
	   $model->filename = 'upload/' . Yii::$app->user->identity['login'] . '/' .
	   		    $somefile->baseName . date_timestamp_get($date). '.' . $somefile->extension;
	   $model->save();
	   $somefile->saveAs($model->filename);
	   	   
	    $model->save(false);
	    $model->caption = $model->filename.';'.$model->caption;
	    $model->save();
	    return $this->redirect(['view', 'id' => $model->id ]);
        }

        return $this->render('create', [
            'model' => $model,
	    
        ]);
    }

    /**
     * Updates an existing Images model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	if (substr_count(explode(';', $model->caption)[0],
	   Yii::$app->user->identity['login']) == 0)
		return $this->redirect(['index']);
	$model->caption = '';
	if ($model->load(Yii::$app->request->post()) && $model->save()) {
	   $somefile = UploadedFile::getInstance($model, 'filename');
	   $model->filename = 'upload/' . Yii::$app->user->identity['login'] . '/' .
	   		    $somefile->baseName . date_timestamp_get($data). '.' . $somefile->extension;
	   $model->save();
	   $somefile->saveAs($model->filename);
	   $data = date_create();
	   
	    $model->save(false);
	    $model->caption = $model->filename.';'.$model->caption;
	    $model->save();
	   return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAskdelete($id)
    {
	$model = $this->findModel($id);
	if (substr_count(explode(';', $model->caption)[0],
	   Yii::$app->user->identity['login']) == 0)
		return $this->redirect(['index']);
        return $this->render('askdelete', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing Images model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
	$model = $this->findModel($id);
        $model->delete();
	return $this->redirect(['index']);
        
    }

    /**
     * Finds the Images model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Images the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Images::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}
