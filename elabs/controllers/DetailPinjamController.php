<?php

namespace app\controllers;

use Yii;
use app\models\DetailPinjam;
use app\models\DetailPinjamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Peminjaman;
use yii\data\ActiveDataProvider;

/**
 * DetailPinjamController implements the CRUD actions for DetailPinjam model.
 */
class DetailPinjamController extends Controller
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
     * Lists all DetailPinjam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetailPinjamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetailPinjam model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DetailPinjam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_pinjam=null, $id_inventaris_brg=null)
    {
        $model = new DetailPinjam();
        $model->id_inventaris_brg = $id_inventaris_brg;

        // $model->id_inventaris_brg = $id_inventaris_brg;
        // $model->id_pinjam = $id_pinjam; //= Yii::$app->peminjaman->identity->id;        
        // $model->id_inventaris_brg = $id_inventaris_brg; //= Yii::$app->peminjaman->identity->id;        
        /**/
        if ($model->load(Yii::$app->request->post())) {
            $model->id_pinjam = $id_pinjam;
            
            if ($model->save()) {
                return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam,'model'=>$model]);
            } else {

                //echo "Eror";
                var_dump($model->errors);
                die;
            }
            
        } 

        if (User::isMhs()) {
         $model->jumlah = 1;
        // $model->id_pinjam = Yii::$app->peminjaman->identity->id;
         $model->id_pinjam = getPeminjaman($id);
         $model->id_inventaris_brg = $id_inventaris_brg;
         $model->save(false);
         Yii::$app->session->setFlash('success', 'Berhasil. ');
         return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam]);
            // if ($model-> save()) {
           
            //     return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam,'model'=>$model]);
            // }
        }
        return $this->render('create', [
            'model' => $model,
            // 'search' => $searchModel,
        
        ]);
    }

    /**
     * Updates an existing DetailPinjam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_detail_pinjam]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DetailPinjam model.
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
     * Finds the DetailPinjam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailPinjam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetailPinjam::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     public function actionTambahBarang($id_inventaris_brg=null)
    {
        $model = new DetailPinjam();
        $model->id_inventaris_brg = $id_inventaris_brg;
        $model->id_pinjam = $id_pinjam; //= Yii::$app->peminjaman->identity->id;        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_pinjam,'model'=>$model]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
