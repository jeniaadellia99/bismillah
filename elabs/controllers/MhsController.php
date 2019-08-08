<?php

namespace app\controllers;

use Yii;
use app\models\Mhs;
use app\models\MhsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\UploadedFile;
use yii\web\Response;
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $foto = UploadedFile::getInstance($model, 'foto');
            $model->foto = time(). '_' . $foto->name;
            $foto->saveAs(Yii::$app->basePath . '/web/upload/mhs/' . $model->foto);
            $model->save();

            $user = new User();
            $user->username = $model->nama;
            $user->password = $model->nim;
            $user->id_user_role = 2;
            $user->id_mhs = $model->id;
            
            $token =  $user->token = Yii::$app->getSecurity()->generateRandomString ( $length = 50 );

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
}
