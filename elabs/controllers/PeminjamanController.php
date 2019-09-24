<?php

namespace app\controllers;

use Yii;
use app\models\Peminjaman;
use app\models\PeminjamanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\InventarisBrg;
use app\models\DetailPinjam;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;

/**
 * PeminjamanController implements the CRUD actions for Peminjaman model.
 */
class PeminjamanController extends Controller
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
     * Lists all Peminjaman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeminjamanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         if (Yii::$app->request->get('export-pdf-sudah')) {
            return $this->exportPdf(Yii::$app->request->queryParams);
        }

         if (Yii::$app->request->get('export-pdf-semua')) {
            return $this->exportPdfSemua(Yii::$app->request->queryParams);
        }

        if (Yii::$app->user->identity->id_user_role == 3) {
             $query = Peminjaman::find()->andWhere(['id_dosen_staf' => Yii::$app->user->identity->id_dosen_staf]);
           $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        }

        if (Yii::$app->user->identity->id_user_role == 2) {
             $query = Peminjaman::find()->andWhere(['id_mhs' => Yii::$app->user->identity->id_mhs]);
           $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        }

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
         if (Yii::$app->request->get('export-pdf')) {
            return $this->exportPdf(Yii::$app->request->queryParams);
        }
        
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
        
        if (User::isMhs())
        {
            $model->id_mhs = Yii::$app->user->identity->id_mhs;
            $model->id_dosen_staf = '0';
            $model->tgl_pinjam = date("Y-m-d H:i:s");
            $model->status = '1';
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
               return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        elseif (User::isAdmin()) {
            $model->tgl_pinjam = date("Y-m-d H:i:s");
            $model->status = '2';
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        elseif (User::isDosenStaf()) {
            $model->id_dosen_staf = Yii::$app->user->identity->id_dosen_staf;
            $model->id_mhs = '0';
            $model->tgl_pinjam = date("Y-m-d H:i:s");
            $model->status = '1';
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
    public function actionAccBarang($id=null)
    {
        $model = Peminjaman::findOne($id);
        
        $model->status = 2;

        $model->save(false);

        Yii::$app->session->setFlash('Berhasil', 'Barang sudah boleh dipinjam');

        if (User::isAdmin()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(['peminjaman/index']);
        }
    }
     public function actionKembalikanBarang($id=null)
    {
        $model = Peminjaman::findOne($id);
        $model->tgl_kembali = date('Y-m-d');
        
        $model->status = 3;

          $model->save(false);

           Yii::$app->session->setFlash('Berhasil', 'Barang sudah berhasil di kembalikan');

        if (User::isAdmin()|| User::isMhs()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(['peminjaman/index']);
        }
    }

    public function actionPdf($id)
    {

        $model = \app\models\Peminjaman::findOne($id);
        $content = $this->renderPartial('/template/pengembalian', [
                     'model' => $model,
                     'id' => $id,

                     ]);
         $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 10px;
            border: 1px solid #0000;
            text-align: center;
        }
        .table-pdf th {
            border: 1px solid #0000;
            background-color: #eee;
            text-align: center;
        }
CSS;

       
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
           
             // set mPDF properties on the fly
            'options' => ['title' => 'Linen - Supervisi Outsourcing'],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]

        ]);

        $date = date('Y-m-d His');

        $pdf->filename = "Data Peminjaman - ".$date.".pdf";

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionPdfSudah()
    {
        $searchModel = new PeminjamanSearch();
        $searchModel = Peminjaman::find()->where(['status'=>3])->all();       
        $content = $this->renderPartial('/template/peminjaman',['model' => $searchModel]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 10px;
            border: 1px solid #0000;
            text-align: center;
        }
        .table-pdf th {
            border: 1px solid #0000;
            background-color: #eee;
            text-align: center;
        }
CSS;

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline,
             // set mPDF properties on the fly
            'options' => ['title' => 'Linen - Supervisi Outsourcing'],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);

        $date = date('Y-m-d His');

        $pdf->filename = "Peminjaman-Sudah_Dikembalikan - ".$date.".pdf";

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
     public function actionPdfSedang()
    {
        $searchModel = new PeminjamanSearch();
        $searchModel = Peminjaman::find()->where(['status'=>2])->all();       
        $content = $this->renderPartial('/template/peminjaman',['model' => $searchModel]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 10px;
            border: 1px solid #0000;
            text-align: center;
        }
        .table-pdf th {
            border: 1px solid #0000;
            background-color: #eee;
            text-align: center;
        }
CSS;

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline,
             // set mPDF properties on the fly
            'options' => ['title' => 'Linen - Supervisi Outsourcing'],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);

        $date = date('Y-m-d His');

        $pdf->filename = "Peminjaman-Belum_Dikembalikan - ".$date.".pdf";

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
      
    public function exportPdfSemua($params)
    {
        $searchModel = new PeminjamanSearch();
        $searchModel = $searchModel->getQuerySearch($params)->all();     
        $content = $this->renderPartial('/template/peminjaman-all',['model' => $searchModel]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 10px;
            border: 1px solid #0000;
            text-align: center;
        }
        .table-pdf th {
            border: 1px solid #0000;
            background-color: #eee;
            text-align: center;
        }
CSS;

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline,
             // set mPDF properties on the fly
            'options' => ['title' => 'Linen - Supervisi Outsourcing'],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);

        $date = date('Y-m-d His');

        $pdf->filename = "Peminjaman-Belum_Dikembalikan - ".$date.".pdf";

        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}
