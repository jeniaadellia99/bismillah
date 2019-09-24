<?php

namespace app\controllers;

use Yii;
use app\models\Pengembalian;
use app\models\PengembalianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Peminjaman;
use app\models\DetailPinjam;
use app\models\InventarisBrg;
use app\models\Mhs;
use kartik\mpdf\Pdf;
/**
 * PengembalianController implements the CRUD actions for Pengembalian model.
 */
class PengembalianController extends Controller
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
     * Lists all Pengembalian models.
     * @return mixed
     */
    public function actionIndex()
    {
              
        $searchModel = new PengembalianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengembalian model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $id_pinjam)
    {
        
        $model = $this->findModel($id);
        $peminjaman = Pengembalian::findAllDetailPinjam($id_pinjam);
        $mahasiswa = Mhs::findOne($model->peminjaman->id_mhs);
        //$status = Peminjaman::findOne($model->peminjaman->status);

        return $this->render('view', [
            'id_pinjam'=>$id_pinjam,
            'model' => $model,
            'semuaPeminjaman' => $peminjaman,
            'mahasiswa' => $mahasiswa,
            //'status' => $status,
        ]);
    }

    /**
     * Creates a new Pengembalian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_detail_pinjam=null,$id_pinjam=null)
    {
        $model = new Pengembalian();
        $model->id_pinjam = $id_pinjam;
        $model->tgl_kembali = date("Y-m-d H:i:s");
        if ($model->load(Yii::$app->request->post())) {
        $model->save(false);
        $detail = DetailPinjam::findOne($id_pinjam); 
        $detail->status='3';
        $detail->save();
        $peminjaman = Peminjaman::findOne($id_pinjam); 
        $peminjaman->status='3';
        $peminjaman->save();
        if($id_detail_pinjam==null){
            $detail_pinjam = DetailPinjam::find()->where(['id_pinjam' => $id_pinjam])->all();
        } else {
            $detail_pinjam = DetailPinjam::find()->where(['id_detail_pinjam' => $id_detail_pinjam])->all();

        }

        foreach ($detail_pinjam as $value) {
             $inventaris_brg = InventarisBrg::findOne($value->id_inventaris_brg);        
             $inventaris_brg->jumlah_brg = ((integer) $inventaris_brg->jumlah_brg)+$value->jumlah;
             $inventaris_brg->jumlah_brg = (string) $inventaris_brg->jumlah_brg;
             $inventaris_brg->save();
        }

       
    }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // var_dump(array('view', 'id' => $model->id, 'id_pinjam' => $id_pinjam));
    // die();
            return $this->redirect(['view', 'id' => $model->id, 'id_pinjam' => $id_pinjam]);
        }

// var_dump("kalo salah ksini");
//             die;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pengembalian model.
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
     * Deletes an existing Pengembalian model.
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
     * Finds the Pengembalian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengembalian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengembalian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionKembalikanBarang()
    {
        echo "string";
    }
   public function actionPdf($id)
    {

        $model = \app\models\Pengembalian::findOne($id);
        $content = $this->renderPartial('/template/pengembalian2', [
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
}
