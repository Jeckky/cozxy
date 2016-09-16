<?php

namespace backend\modules\led\controllers;

use Yii;
use common\models\costfit\LedItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LedItemController implements the CRUD actions for LedItem model.
 */
class LedItemController extends LedItemMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all LedItem models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new LedItem();
        $query = LedItem::find();
        $count = 0;
        if (isset($_GET['id'])) {
            $count = count(LedItem::find()->where("ledId=" . $_GET['id'])->all());
            //throw new \yii\base\Exception($count);
            $query = LedItem::find()->where("ledId=" . $_GET['id'] . " order by sortOrder");
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'count' => $count
        ]);
    }

    /**
     * Displays a single LedItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new LedItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new LedItem();
        $defultColor = ['1', '2', '3', '4', '5'];

        $oldColor = [];
        $sort = [];
        $i = 0;
        $j = 1;
        $oldLed = LedItem::find()->where("ledId=" . $_GET['ledId'] . " order by sortOrder")->all(); //ตรวจสอบว่า ตอนนี้มี LED สีอะไรอยู่บ้างแล้ว
        if (isset($oldLed)) {
            foreach ($oldLed as $led) {
                $oldColor[$i] = $led->color;
                $i++;
            }
        }
        if (count($oldLed) == 0) {//ถ้าไม่มี record ให้เริ่ม sort ที่ 1
            $sort[$j] = 1;
        } else {
            $sort[count($oldLed) + 1] = count($oldLed) + 1;
        }
        if (isset($_POST["LedItem"])) {// ถ้ามีการ POST เข้ามา
            //throw new \yii\base\Exception('aaa');
            if (isset($_POST['color']) && !empty($_POST['color'])) {
                $model->color = $_POST['color'];
            } else {
                //$lastColor = LedItem::find()->where("ledId=" . $_GET['ledId'] . " order by sortOrder DESC limit 0,1")->one();
                foreach ($defultColor as $dColor) {
                    $findColor = LedItem::find()->where("ledId=" . $_GET['ledId'] . " and color=" . $dColor)->one();

                    if (!isset($findColor) && empty($findColor)) {
                        //throw new \yii\base\Exception(1111);
                        $model->color = $dColor;
                        break;
                    }
                }
                //  $model->color = isset($lastColor) ? $defultColor[$lastColor->color + 1] : $defultColor[0];
            }
            $model->ledId = $_GET['ledId'];

            $model->sortOrder = $_POST['LedItem']['sortOrder'];
            $model->status = 1;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(false)) {
                return $this->redirect(['../led/led-item', 'id' => $_GET['ledId']]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'defultColor' => $defultColor,
                        'oldColor' => $oldColor,
                        'sort' => $sort
            ]);
        }
    }

    /**
     * Updates an existing LedItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $defultColor = ['1', '2', '3', '4', '5'];
        $oldColor = [];
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $j = 1;
        $led = LedItem::find()->where("ledItemId=" . $id)->one();
        $model = LedItem::find()->where("ledItemId=" . $id)->one();
        $oldLed = LedItem::find()->where("ledId=" . $led->ledId)->all();
        if (isset($oldLed)) {
            $i = 0;
            foreach ($oldLed as $led) {
                $oldColor[$i] = $led->color;
                $i++;
            }
        }
        if (count($oldLed) == 0) {//ถ้าไม่มี record ให้เริ่ม sort ที่ 1
            $sort[$j] = 1;
        } else {
            foreach ($oldLed as $count) {
                $sort[$j] = $j;
                $j++;
            }
        }
        if (isset($_POST["LedItem"])) {
            //throw new \yii\base\Exception('aaa');
            $model->color = isset($_POST['color']) ? $_POST['color'] : $model->color;
            $model->ledId = $led->ledId;
            $model->sortOrder = $_POST['LedItem']['sortOrder'];
            $model->status = 1;
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(false)) {
                return $this->redirect(['../led/led-item', 'id' => $led->ledId]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'defultColor' => $defultColor,
                        'oldColor' => $oldColor,
                        'sort' => $sort
            ]);
        }
    }

    /**
     * Deletes an existing LedItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        //  throw new \yii\base\Exception($id);
        $led = \common\models\costfit\LedItem::find()->where("ledItemId=" . $id)->one();
        $this->findModel($id)->delete();
        return $this->redirect(['../led/led-item', 'id' => $led->ledId]);
    }

    /**
     * Finds the LedItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LedItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LedItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
