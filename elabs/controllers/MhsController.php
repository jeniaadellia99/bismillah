<?php

namespace app\controllers;

use Yii;
use app\models\Mhs;
use app\models\MhsSearch;
use app\models\Jurusan;
use app\models\JurusanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\UploadedFile;
use yii\web\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

/**
 * MhsController implements the CRUD actions for Mhs model.
 */
class MhsController extends Controller
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
     * Lists all Mhs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MhsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if (Yii::$app->request->get('export-excel-ti')) {
            return $this->exportExcel(Yii::$app->request->queryParams);
        }

        if (Yii::$app->request->get('export-excel-tm')) {
            return $this->exportExcel(Yii::$app->request->queryParams);
        }

        if (Yii::$app->request->get('export-excel-tp')) {
            return $this->exportExcel(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mhs model.
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
     * Creates a new Mhs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mhs();

        // Membuat validasi untuk di from tertentu yang sudah ada di databases tidak bisa dibuat kembali.
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // ambil file berkas dan file sampul yg ada di _from.
            $foto = UploadedFile::getInstance($model, 'foto');
            // merubah nama filenya.
            $model->foto = time() . '_' . $foto->name;
            // lokasi simpan file.
            $foto->saveAs(Yii::$app->basePath . '/web/upload/mhs' . $model->foto);

            $model->save();

            $user = new User();

            $user->username = $model->nama;
            $user->password = $model->nim;
            $user->id_mhs = $model->id;
            $user->id_user_role = 2;
            $user->id_mhs = 0;
            $user->id_dosen_staf = 0;
                      
            $user->token = Yii::$app->getSecurity()->generateRandomString ( $length = 50 );
            
            $user->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mhs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Membuat validasi untuk di from tertentu yang sudah ada di databases tidak bisa dibuat kembali.
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        // Mengambi data lama di databases
        $foto_lama = $model->foto;

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            
            // Mengambil data baru di layout _from
            $foto = UploadedFile::getInstance($model, 'foto');

            // Jika ada data file yang dirubah maka data lama akan di hapus dan di ganti dengan data baru yang sudah diambil jika tidak ada data yang dirubah maka file akan langsung save data-data yang lama.
            if ($foto !== null) {
                unlink(Yii::$app->basePath . '/web/upload/mhs/' . $foto_lama);
                $model->foto = time() . '_' . $foto->name;
                $foto->saveAs(Yii::$app->basePath . '/web/upload/mhs/' . $model->foto);
            } else {
                $model->foto = $foto_lama;
            }

            // Simapan data ke databases
            $model->save(false);

            // Menuju ke view id yang data dibuat.
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mhs model.
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
     * Finds the Mhs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mhs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mhs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionExportExcelTi()
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0);
        
        $sheet = $spreadsheet->getActiveSheet();
        
        $setBorderArray = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(15);
       

        $sheet->setCellValue('A3', strtoupper('No'));
        $sheet->setCellValue('B3', strtoupper('Nama'));
        $sheet->setCellValue('C3', strtoupper('Jurusan'));
        $sheet->setCellValue('D3', strtoupper('NIM'));
   

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Data Mahasiswa');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'Jurusan Teknik Informatika');

        $spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->setFillType(Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->getStartColor()->setARGB('d8d8d8');
        $spreadsheet->getActiveSheet()->mergeCells('A1:L1');
        $spreadsheet->getActiveSheet()->mergeCells('A2:L2');
        $spreadsheet->getActiveSheet()->getDefaultRowDimension('3')->setRowHeight(25);
        $sheet->getStyle('A1:L3')->getFont()->setBold(true);
        $sheet->getStyle('A1:L3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $row = 3;
        $i=1;

        $searchModel = new MhsSearch();
        $query = Mhs::find()->where(['id_jurusan'=>1])->all();
        foreach($query as $minat){

            $row++;
            $sheet->setCellValue('A' . $row, $i);
            $sheet->setCellValue('B' . $row, @$minat->nama);
            $sheet->setCellValue('C' . $row, @$minat->id_jurusan);
            $sheet->setCellValue('D' . $row, @$minat->nim);
            //$sheet->setCellValue('E' . $row, @$minat->jurusan->nama_jurusan);
           

            $i++;
        }

        $sheet->getStyle('A3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A3:L' . $row)->applyFromArray($setBorderArray);

        $filename = time() . '_Data-Mahasiswa-Teknik-Informatika.xlsx';
        $path = 'export/' . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return $this->redirect($path);
    }

    public function actionExportExcelTm()
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0);
        
        $sheet = $spreadsheet->getActiveSheet();
        
        $setBorderArray = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(15);
       

        $sheet->setCellValue('A3', strtoupper('No'));
        $sheet->setCellValue('B3', strtoupper('Nama'));
        $sheet->setCellValue('C3', strtoupper('Jurusan'));
        $sheet->setCellValue('D3', strtoupper('NIM'));
   

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Data Mahasiswa');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'Jurusan Teknik Mesin');

        $spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->setFillType(Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->getStartColor()->setARGB('d8d8d8');
        $spreadsheet->getActiveSheet()->mergeCells('A1:L1');
        $spreadsheet->getActiveSheet()->mergeCells('A2:L2');
        $spreadsheet->getActiveSheet()->getDefaultRowDimension('3')->setRowHeight(25);
        $sheet->getStyle('A1:L3')->getFont()->setBold(true);
        $sheet->getStyle('A1:L3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $row = 3;
        $i=1;

        $searchModel = new MhsSearch();
        $query = Mhs::find()->where(['id_jurusan'=>2])->all();
        foreach($query as $minat){

            $row++;
            $sheet->setCellValue('A' . $row, $i);
            $sheet->setCellValue('B' . $row, @$minat->nama);
            $sheet->setCellValue('C' . $row, @$minat->id_jurusan);
            $sheet->setCellValue('D' . $row, @$minat->nim);
            //$sheet->setCellValue('E' . $row, @$minat->jurusan->nama_jurusan);
           

            $i++;
        }

        $sheet->getStyle('A3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A3:L' . $row)->applyFromArray($setBorderArray);

        $filename = time() . '_Data-Mahasiswa-Teknik-Mesin.xlsx';
        $path = 'export/' . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return $this->redirect($path);
    }

    public function actionExportExcelTp()
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0);
        
        $sheet = $spreadsheet->getActiveSheet();
        
        $setBorderArray = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(15);
       

        $sheet->setCellValue('A3', strtoupper('No'));
        $sheet->setCellValue('B3', strtoupper('Nama'));
        $sheet->setCellValue('C3', strtoupper('Jurusan'));
        $sheet->setCellValue('D3', strtoupper('NIM'));
   

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Data Mahasiswa');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'Jurusan Teknik Pendingin dan Tata Udara');

        $spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->setFillType(Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->getStartColor()->setARGB('d8d8d8');
        $spreadsheet->getActiveSheet()->mergeCells('A1:L1');
        $spreadsheet->getActiveSheet()->mergeCells('A2:L2');
        $spreadsheet->getActiveSheet()->getDefaultRowDimension('3')->setRowHeight(25);
        $sheet->getStyle('A1:L3')->getFont()->setBold(true);
        $sheet->getStyle('A1:L3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $row = 3;
        $i=1;

        $searchModel = new MhsSearch();
        $query = Mhs::find()->where(['id_jurusan'=>3])->all();
        foreach($query as $minat){

            $row++;
            $sheet->setCellValue('A' . $row, $i);
            $sheet->setCellValue('B' . $row, @$minat->nama);
            $sheet->setCellValue('C' . $row, @$minat->id_jurusan);
            $sheet->setCellValue('D' . $row, @$minat->nim);
            //$sheet->setCellValue('E' . $row, @$minat->jurusan->nama_jurusan);
           

            $i++;
        }

        $sheet->getStyle('A3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:L' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A3:L' . $row)->applyFromArray($setBorderArray);

        $filename = time() . '_Data-Mahasiswa-Teknik-Pendingin.xlsx';
        $path = 'export/' . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return $this->redirect($path);
    }


}
