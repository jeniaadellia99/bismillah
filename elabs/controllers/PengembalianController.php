<?php

namespace app\controllers;

use Yii;
use app\models\Pengembalian;
use app\models\PengembalianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\PeminjamanSearch;
use app\models\Peminjaman;
use yii\filters\AccessControl;

/**
 * PeminjamanController implements the CRUD actions for Peminjaman model.
 */
class PengembalianController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

            // Access Control URL.
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['update', 'view', 'delete'],
                        'allow' => User::isAdmin(),
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'kembalikan-buku'],
                        'allow' => User::isMhs(),
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
     * Lists all Peminjaman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeminjamanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Peminjaman model.
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
     * Creates a new Peminjaman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Peminjaman();
        if (User::isMhs()) {
            $model->id_mhs = Yii::$app->user->identity->id_mhs;
            $model->status = '1';
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                
            return $this->redirect(['view', 'id' => $model->id]);
        }
        }
        elseif (User::isAdmin()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Peminjaman model.
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
     * Deletes an existing Peminjaman model.
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
     * Finds the Peminjaman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Peminjaman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Peminjaman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function KembalikanBarang($value='')
    {
        $model = Peminjaman::findOne($id);
        $model->tgl_kembali = date('Y-m-d');
        
        $model->status = 4;

          $model->save(false);

           Yii::$app->session->setFlash('Berhasil', 'Buku sudah berhasil di kembalikan');

        if (User::isMhs()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(['pengembalian/index']);
        }
    }
    public function actionCekStatus()
    {
        $query = Peminjaman::find()
            ->andWhere(['<','tgl_pinjam',date('Y-m-d')])
            ->andWhere(['tgl_kembali' => null])
            ->all();

        /*
        $query = Peminjaman::find()
            ->andWhere(['tanggal_kembali' => date('Y-m-d')])
            ->all();
        */

        foreach ($query as $peminjaman) {
            $peminjaman->status= Peminjaman::DIKEMBALIKAN;
            $peminjaman->save();
        }

        // return $this->goBack();
    }
}
