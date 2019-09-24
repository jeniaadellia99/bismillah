<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Mhs;
use yii\data\ActiveDataProvider;
use app\models\PencarianInventarisBrg;
use app\models\InventarisBrg;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (User::isAdmin()) {
           return $this->redirect(['site/dashboard']);
        }if (User::isMhs() || User::isDosenStaf()) {
          return $this->redirect(['site/about']);
        }if (User::isDosenStaf()) {
          return $this->redirect(['site/about']);
        }
        else{
            return $this->redirect(['site/login']);
        }
    }

    public function actionDashboard()
    {
      if (User::isDosenStaf()) {
            $searchModel = new PencarianInventarisBrg();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $request = json_decode(json_encode(Yii::$app->request->queryParams));
            
              return $this->render('dashboard', [
                'searchModel' => $searchModel,
                'provider' => $dataProvider,
                'id_pinjam' => $request->id_pinjam,
            ]);

           }
        if (User::isMhs()) {
               $searchModel = new PencarianInventarisBrg();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $request = json_decode(json_encode(Yii::$app->request->queryParams));
            
              return $this->render('dashboard', [
                'searchModel' => $searchModel,
                'provider' => $dataProvider,
               'id_pinjam' => $request->id_pinjam,
            ]);

           }if (User::isAdmin()) {
            $searchModel = new PencarianInventarisBrg();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $request = json_decode(json_encode(Yii::$app->request->queryParams));
            
              return $this->render('dashboard', [
                'searchModel' => $searchModel,
                'provider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['site/login']);
        }
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
