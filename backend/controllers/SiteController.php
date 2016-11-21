<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends \backend\controllers\BackendMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        // return $this->render('index');
        $this->redirect(Yii::$app->homeUrl . 'auth');
    }

    public function actionLogin() {
        // throw new \yii\base\Exception('cc');
        /* if (!Yii::$app->user->isGuest) {
          throw new \yii\base\Exception('cc');
          return $this->goHome();
          } */
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //throw new \yii\base\Exception(Yii::$app->user->identity->userId);
            if (Yii::$app->user->identity->type != 1) {
                \common\models\costfit\User::updateAll(['lastvisitDate' => new \yii\db\Expression("NOW()")], ['userId' => Yii::$app->user->identity->userId]);
                return $this->redirect(Yii::$app->homeUrl . 'dashboard');
            } else if (Yii::$app->user->identity->type == 2) {
                \common\models\costfit\User::updateAll(['lastvisitDate' => new \yii\db\Expression("NOW()")], ['userId' => Yii::$app->user->identity->userId]);
                return $this->redirect(Yii::$app->homeUrl . 'dashboard');
            } else if (Yii::$app->user->identity->type == 3) {
                \common\models\costfit\User::updateAll(['lastvisitDate' => new \yii\db\Expression("NOW()")], ['userId' => Yii::$app->user->identity->userId]);
                return $this->redirect(Yii::$app->homeUrl . 'dashboard');
            } else {
                return $this->redirect(Yii::$app->homeUrl . 'auth');
            }
            //return $this->goBack();
        } else {
            // throw new \yii\base\Exception('ccaa');
            return $this->redirect('../auth', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->homeUrl . '/dashboard');
    }

    public function actionProduct($id) {
        $product = \common\models\costfit\search\Product::find()->where("categoryId =" . $id);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $product,
        ]);
        return $this->render('_index_product', compact('dataProvider'));
    }

    public function actionProductView($id) {
        $model = \common\models\costfit\search\Product::find()->where("productId = " . $id)->one();
        return $this->render('_product_view', compact('model'));
    }

}
