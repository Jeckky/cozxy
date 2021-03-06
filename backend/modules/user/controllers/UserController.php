<?php

namespace backend\modules\user\controllers;

use Yii;
use common\models\costfit\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends UserMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        //throw new \yii\base\Exception('aaa');
        $model = new User();
        $query = User::find()
                ->JOIN('LEFT JOIN', '`order` o', 'o.userId=`user`.userId')
                ->where("o.status>=" . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS)
                ->orderBy("o.paymentDateTime DESC");
        if (isset($_GET['searchName'])) {
            $query = User::find()->where("firstname like '%" . $_GET['searchName'] . "%' or lastname like '%" . $_GET['searchName'] . "%' or email like '%" . $_GET['searchName'] . "%'");
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionMailSend() {
        $email = new \backend\controllers\EmailSend();
        $toMail = 'saknakhngam@hotmail.com';
        $userName = 'Surasak Nakngam';
        $password = '123456';
        $picking = \common\models\costfit\PickingPoint::find()->where("pickingId=20")->one();
        $location = $picking->title;
        $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . 'my-account?act=order-history';
        $img = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . $picking->mapImages;
        $address = $picking->description;
        $lat = $picking->latitude;
        $long = $picking->longitude;
        $email->mailSendPassword($toMail, $userName, $password, $location, $img, $url, $address, $lat, $long);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->userId]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->userId]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionBlock($id) {
        //
        $model = User::find()->where("userId=" . $_GET['id'])->one();
        if (isset($_GET['id'])) {
            $model->status = 99;
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->save(false);
            return $this->redirect(['index']);
        }
    }

    public function actionUnBlock($id) {
        //
        $model = User::find()->where("userId=" . $_GET['id'])->one();
        if (isset($_GET['id'])) {
            $model->status = 1;
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->save(false);
            return $this->redirect(['index']);
        }
    }

    public function actionConfiguration() {
        $dataProvider = new ActiveDataProvider([
            'query' => \common\models\costfit\Configuration::find()->where("1"),
        ]);
        return $this->render('config', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdateConfig() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $configutation = \common\models\costfit\Configuration::find()->where("configurationId=" . $id)->one();
        }
        return $this->render('updateConfig', [
                    'configutation' => isset($configutation) ? $configutation : false
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOrderHistory() {
        $userId = $_GET['id'];
        $user = User::find()->where("userId=" . $userId)->one();
        $model = \common\models\costfit\Order::find()->where("userId=" . $userId . " and status>=" . \common\models\costfit\Order::ORDER_STATUS_E_PAYMENT_SUCCESS)
                ->orderBy("paymentDateTime DESC")
                ->all();
        return $this->render('order', [
                    'model' => $model,
                    'userName' => $user->firstname . " " . $user->lastname
        ]);
    }

}
