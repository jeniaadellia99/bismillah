<?php

namespace app\controllers;

use Yii;
use app\models\DosenStaf;
use app\models\DosenStafSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\UploadedFile;
use yii\web\Response;

/**
 * DosenStafController implements the CRUD actions for DosenStaf model.
 */
class DosenStafController extends Controller
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
     * Lists all DosenStaf models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DosenStafSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DosenStaf model.
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
     * Creates a new DosenStaf model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DosenStaf();

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
            $foto->saveAs(Yii::$app->basePath . '/web/upload/dosen' . $model->foto);

            $model->save();

            $user = new User();

            $user->username = $model->nama;
            $user->password = $model->nik;
            $user->id_dosen_staf = $model->id;
            $user->id_user_role = 3;
            $user->id_mhs = 0;
                      
            $user->token = Yii::$app->getSecurity()->generateRandomString ( $length = 50 );
            
            $user->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DosenStaf model.
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
     * Deletes an existing DosenStaf model.
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
     * Finds the DosenStaf model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DosenStaf the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DosenStaf::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
