<?php

namespace backend\modules\order\controllers;

use Yii;
use common\models\costfit\Order;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\OrderPaymentHistory;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends OrderMasterController {

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

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where("status >" . Order::ORDER_STATUS_REGISTER_USER . "")->orderBy("updateDateTime DESC"),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($hash) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $order = \common\models\costfit\Order::find()->where('orderId = "' . $params['id'] . '" ')
                ->one();
        return $this->render('@frontend/views/profile/purchase_order', compact('order'));
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Order();
        if (isset($_POST["Order"])) {
            $model->attributes = $_POST["Order"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Order"])) {
            $model->attributes = $_POST["Order"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrintPurchaseOrder($hash, $title) {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        $this->layout = "payment/content";
        $this->title = 'Cost.fit | Order Purchase ';
        $this->subTitle = 'Home';
//        $this->subSubTitle = "Order Purchase";
        $orderId = $params['orderId'];

        //echo htmlspecialchars($orderId);
        //echo $orderId;
        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('orderId = "' . $params['orderId'] . '" ')
                    ->one();
        } else {
            return $this->redirect(['profile/order']);
        }

        //$content = $this->renderPartial('purchase_order');
        $content = $this->renderPartial('@frontend/views/payment/purchase_order', compact('order'));
        $this->actionMpdfDocument($content);
    }

    public function actionPrintPayIn() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout_payment = "/content";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";

        return $this->render('payment');
    }

    public function actionPaymentHistory() {
        //  throw new \yii\base\Exception($_GET['orderId']);
        if (isset($_GET['orderId'])) {
            $order = Order::find()->where("orderId='" . $_GET['orderId'] . "'")->one();
            $dataProvider = new ActiveDataProvider([
                'query' => OrderPaymentHistory::find()->where("orderId='" . Yii::$app->request->get('orderId') . "'")->orderBy("updateDateTime DESC"),
            ]);

            return $this->render('payment', [
                        'dataProvider' => $dataProvider,
                        'order' => $order
            ]);
        } else {
            return $this->render('@app/views/error/error');
        }
    }

}
