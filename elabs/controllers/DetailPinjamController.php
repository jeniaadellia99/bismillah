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
use app\models\InventarisBrg;
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
        $model->id_inventaris_brg = $id_inventaris_brg; // model
        if ($model->load(Yii::$app->request->post())) {
            $model->id_pinjam = $id_pinjam; // model
            $id_inventaris_brg = $model->id_inventaris_brg; //model
            $jumlah = $model->jumlah;
            $model->status = 1; //model
            $request = Yii::$app->request->post();
            $request = json_decode(json_encode($request));
        
            $modelbarang_db = InventarisBrg::findOne($id_inventaris_brg); //select berdasarkan barang
            // BARANG 0
            if ($modelbarang_db->jumlah_brg < $request->DetailPinjam->jumlah) {
                Yii::$app->session->setFlash('danger', 'BARANG TIDAK ADA / BARANG SEDANG DI PINJAM');
                return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam,'model'=>$model]);

            }
            // BARANG ADA 
            if ($model->save($modelbarang_db))
            {
                 Yii::$app->session->setFlash('success', 'Barang Berhasil Ditambahkan');
                return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam,'model'=>$model]);
            }
            else
            {
                echo "tidak ada";
            }
        } 
        if (Yii::$app->user->identity->id_user_role == 2 || Yii::$app->user->identity->id_user_role == 3) {
        $model = new DetailPinjam();
        $model->id_inventaris_brg = $id_inventaris_brg;
        $request = json_decode(json_encode(Yii::$app->request->queryParams));
        if ($model->load(Yii::$app->request->post())) {
            $model->id_inventaris_brg = $request->id_inventaris_brg;
            $model->id_pinjam = $request->id_pinjam;
            $model->status = 2;

            $request = Yii::$app->request->post();
            $request = json_decode(json_encode($request));
            $modelbarang_db = InventarisBrg::findOne($id_inventaris_brg);

            if ($modelbarang_db->jumlah_brg < $request->DetailPinjam->jumlah) {
                Yii::$app->session->setFlash('danger', 'BARANG TIDAK ADA/SEDANG DI PINJAM');
                return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam,'model'=>$model]);

            }
            // if ($model->status==1) {
            //     # code...
            // }
            if ($model->save($modelbarang_db))
            {
                 Yii::$app->session->setFlash('success', 'Barang Berhasil Ditambahkan');
                return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam,'model'=>$model]);
            }
        }
       
       

       
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
           return $this->redirect(['peminjaman/view', 'id' => $model->id_pinjam]);
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
        $model = $this->findModel($id)->delete();

     return $this->redirect(['peminjaman/view', 'id_pinjam' => $model->id_pinjam ]);
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
    public function actionAccBarang($id_detail_pinjam=null)
    {
        $model = DetailPinjam::findOne($id_detail_pinjam);
        
        $model->status = 2;

        $model->save(false);

        Yii::$app->session->setFlash('Berhasil', 'Barang sudah boleh dipinjam');


        $value = DetailPinjam::findOne($id_detail_pinjam);

        $inventaris_brg = InventarisBrg::findOne($value->id_inventaris_brg);        
        
        $inventaris_brg->jumlah_brg = ((integer) $inventaris_brg->jumlah_brg)-$value->jumlah;
        
        $inventaris_brg->jumlah_brg = (string) $inventaris_brg->jumlah_brg;
        
        $inventaris_brg->save();

        
        if (User::isAdmin()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(['peminjaman/index']);
        }
    }
    public function actionAccSebagian($id_detail_pinjam=null)
    {
        $model = DetailPinjam::findOne($id_detail_pinjam);
        
        $model->status = 2;

        $model->save(false);

        if (User::isAdmin()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(['detail-pinjam/update',"id"=>$id_detail_pinjam]);
        }
    }

}
