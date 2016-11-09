<?php

namespace backend\modules\auth\controllers;

use Yii;
use yii\helpers\Url;
use common\models\costfit\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\NotFoundHttpException;

class AuthController extends AuthMasterController {

    public $username;
    public $password;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $model = new LoginForm();
        $session = Yii::$app->session;

        try {
            if (isset($_POST['LoginForm'])) {

                $model->attributes = $_POST['LoginForm'];

                if (isset($model->username) && isset($model->password)) {
                    $query = User::find();
                    $user = $query
                    ->where('email =  "' . $model->username . '"   ')
                    ->andWhere('password =  "' . md5($model->username . $model->password) . '"   ')
                    ->orderBy('createDateTime desc')
                    ->limit(1)
                    ->one();

                    if (isset($user->email) && (isset($user->password))) {
                        $session['firstname'] = $user->firstname;
                        $session['userId'] = $user->userId;
                        $session['type'] = $user->type;

                        //echo $user->firstname = $session['firstname'];  // get session variable 'name1'
                        //echo $user->userId = $session['userId'];  // get session variable 'name2'
                        $this->redirect(Yii::$app->getUrlManager()->getBaseUrl() . '/dashboard');
                    } else {
                        return $this->render('index');
                    }
                } else {
                    return $this->render('index');
                }
            } else {
                return $this->render('index');
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return $this->render('index');
        }

        //return $this->render('index', ['model' => $model]);
    }

    public function actionForgot() {
        // if (!Yii::$app->request->getIsPost) {
        //   $this->redirect('atechwindow/brand');
        // exit(0);
        //}
        //return $this->render('login');
        echo 'Test Login';
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->session->destroy();
        return $this->redirect(Yii::$app->homeUrl . 'auth');
    }

}
