<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\web\UploadedFile;
use app\models\Helper;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        $connection = \Yii::$app->db;
//        $query = $connection->createCommand("SELECT * FROM categoria");
//        $searchModel = $query->queryAll();
        
//        $dataProvider = new ArrayDataProvider([
//            'allModels' => $searchModel,
//            'sort' => [
//                'attributes' => ['categoria'],
//            ],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);
        
//        $searchModel = new Query;
//        $dataProvider = new ArrayDataProvider([
//            'allModels' => $searchModel->from('categoria')->all(),
//            'sort' => [
//                'attributes' => ['categoria'],
//            ],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post())) {

//            $model->created_by = Yii::$app->user->id;
//            $model->updated_by = Yii::$app->user->id;
            
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $model->imagen = Helper::limpiaUrl($model->categoria . '.' . $model->file->extension);
            
            $model->file->saveAs( 'web/img/' . $model->imagen);

            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Categoría creada exitosamente");
            } else {
//                echo "<pre>";
//                print_r($model->getErrors());
//                exit;
                Yii::$app->session->setFlash("error", "La categoría no pudo ser creada");
            }

            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(["index"]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            /*
             * success  -> verde todo ok
             * error    -> rojo  todo mal
             * warning  -> amarillo advertencia
             * info     -> azúl información
             */

            if ($model->save()) {
                Yii::$app->session->setFlash("success","todo correcto");
            } else {
                Yii::$app->session->setFlash("error","no se pudo guardar");
            }



            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
