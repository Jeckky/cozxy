<?php

namespace backend\modules\booth\controllers;

use common\helpers\Email;
use common\models\costfit\OrderItem;
use common\models\costfit\User;
use Yii;
use common\models\costfit\Order;
use common\models\costfit\search\Order as OrderSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Sms;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends BoothMasterController
{
    /**
     * @inheritdoc
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = NULL;

        if(Yii::$app->request->queryParams !== []) {
            $dataProvider = $searchModel->searchBooth(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheckBarcode()
    {
        $res = ['isPackingComplete'=>false];
        if(isset($_POST['barcode']) && isset($_POST['orderId'])) {
            $orderItem = OrderItem::find()
            ->leftJoin('product p', 'p.productId=order_item.productId')
            ->where(['p.isbn'=>$_POST['barcode'], 'order_item.orderId'=>$_POST['orderId']])
                ->andWhere(['<', 'order_item.status', 16])
            ->one();

            if(isset($orderItem)) {
                $orderItem->status = 16;
                $orderItem->save(false);

                //last item update order.status=16
                $orderItemCount = OrderItem::find()->where(['orderId'=>$_POST['orderId']])->andWhere(['!=', 'status', 16])->count();
                if($orderItemCount == 0) {
                    $order = Order::find()->where(['orderId'=>$_POST['orderId']])->one();
                    $password = $order->orderPassword();
                    $order->password = $password;
                    $order->status = Order::ORDER_STATUS_BOOTH_PACKING;
                    $order->save(false);
                    $res['isPackingComplete'] = true;
                    $tel = '66'.substr($order->user->tel, 1);

//                    send sms
                    Sms::Send('POST', SMS::SMS_URL, Json::encode([
                        "from" => "Cozxy",
                        "to" => [$tel],
                        "text" => 'Order No. : '.$order->orderNo.'\r\n รหัสรับสินค้า : '.$order->password
                    ]));

                    $user = User::find()->where(['userId'=>$order->userId])->one();

                    Email::boothReceiveCode($user->username, $order->password, $order->orderNo);
                }

                $res['result'] = true;
                $res['orderItemId'] = $orderItem->orderItemId;
                $res['msg'] = 'ส่ง sms ไปที่เบอร์ '.$order->user->tel;

                return Json::encode($res);
            } else {
                return Json::encode(['result'=>false]);
            }
        }
    }

    public function actionBoothCheckOrderCode()
    {
        if(isset($_POST['orderCode']) && isset($_POST['orderId'])) {
            //check match password & orderId
            $order = Order::find()->where(['password'=>$_POST['orderCode'], 'orderId'=>$_POST['orderId'], 'status'=>Order::ORDER_STATUS_BOOTH_PACKING])->one();

            if(isset($order)) {
                $order->status = Order::ORDER_STATUS_RECEIVED;
                $order->save(false);

                return Json::encode(['result'=>true]);
            }
        }
    }
}
