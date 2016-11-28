<?php

namespace backend\modules\led\controllers;

use Yii;
use common\models\costfit\Led;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LedController implements the CRUD actions for Led model.
 */
class LedController extends LedMasterController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Led models.
     * @return mixed
     */
    public function actionIndex()
    {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        $model = new Led();
        if (isset($_GET['Led']['start']) && isset($_GET['Led']['start']) && isset($_GET['Led']['start'])) {
            $start = $_GET['Led']['start'];
            $end = $_GET['Led']['end'];
            $ip = $_GET['Led']['ip'];
            if ($end < $start) {
                $ms = 'Error input, "End" just more or equal as "Start".';
                return $this->redirect($baseUrl . '/led/led?msg=' . $ms . '&&start=' . $start . '&&end=' . $end . '&&ip=' . $ip);
            }
            $checkIp = [];
            for ($i = $start; $i <= $end; $i++):
                $chekSameIp = true;
                $chekSameIp = $this->chekIp($ip);
                if (!$chekSameIp) {
                    $led = new Led();
                    $led->code = "Led" . $i;
                    $led->status = 1;
                    $led->createDateTime = new \yii\db\Expression('Now()');
                    $led->updateDateTime = new \yii\db\Expression('Now()');
                    $led->ip = $ip;
                    $led->save(false);
                } else {
                    $ms = $ip . ' was exist.';
                    return $this->redirect($baseUrl . '/led/led?msg=' . $ms . '&&start=' . $start . '&&end=' . $end . '&&ip=' . $ip);
                }
                $ledId = Yii::$app->db->getLastInsertID();
                $model->createLedItems($ledId);
                $ip++;
                $checkIp = substr($ip, -3);
                $front = explode('.', $ip);
                // throw new \yii\base\Exception($checkIp);
                if ($checkIp >= '254') {
                    //$showLastIp = ($ip - 1) . '.' . $front[2] . '.253'; // ip address ตัวสุดท้ายที่ สามารถบันทึกได้
                    $ms = 'System has created from ' . $_GET['Led']['ip'] . ' to ' . $showLastIp . ' ip ' . $ip . ' is Unable.';
                    //  $ms = 'System has created from ' . $_GET['Led']['ip'] . ' to ' . $ip-- . ' ip ' . $ip . ' is Unable';
                    return $this->redirect($baseUrl . '/led/led?msg=' . $ms . '&&start=' . $start . '&&end=' . $end . '&&ip=' . $_GET['Led']['ip']);
                }
            endfor;
            $model->code = "Led";
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Led::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Led model.
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
     * Creates a new Led model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Led();
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if (isset($_POST["Led"])) {
            $model->attributes = $_POST["Led"];
            $model->createDateTime = new \yii\db\Expression('Now()');
            $model->updateDateTime = new \yii\db\Expression('Now()');
            $model->status = 1;
            if ($model->save(false)) {
                $ledId = Yii::$app->db->getLastInsertID();
                $model->createLedItems($ledId);
                return $this->redirect($baseUrl . '/led/led');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Led model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($baseUrl . '/led/led');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Led model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $items = \common\models\costfit\LedItem::find()->where("ledId=" . $id)->all();
        foreach ($items as $item) {
            $item->delete();
        }
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        return $this->redirect($baseUrl . '/led/led');
    }

    /**
     * Finds the Led model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Led the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Led::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function chekIp($ip)
    {
        $led = Led::find()->where("ip='" . $ip . "'")->all();
        if (isset($led) and ! empty($led)) {
            return true;
        } else {
            return false;
        }
    }

    public function actionChangeStatus($id)
    {
        $model = Led::find()->where("ledId=$id")->one();
        $model->status = $_GET["status"];
        if ($model->save()) {
            return $this->redirect('index');
        }
    }

    public function actionOpenAllLed()
    {
        $models = Led::find()->where("status=1")->all();

//        throw new \yii\base\Exception(print_r($context, true));\]
        foreach ($models as $item) {
            foreach ($item->ledItems as $index => $led) {
                if ($led->status == 1) {
                    continue;
                }
                $color = \common\models\costfit\LedColor::find()->where("ledColorId=$led->color")->one();
                $r = $color->r;
                $g = $color->g;
                $b = $color->b;
                $id = $index + 1;
//            file_get_contents('http://' . $item->ip . "/", FALSE, $context);
                if (file_get_contents('http://' . $item->ip . "?id=$id&status=1&r=$r&g=$g&b=$b", NULL, NULL, 0, 0) !== FALSE) {
//            throw new \yii\base\Exception("?id=$id&status=$status&r=$r&g=$g&b=$b");
                    $statusText = "Turn On ";
                    $led->status = 1;
                    $led->save();
//                    echo "LED " . $item->code . " " . $statusText . $item->ip . "<br>";
                    break;
                } else {
                    $statusText = "Turn Off ";
//                    echo "LED " . $item->code . " " . $statusText . $item->ip . $exc->getMessage();
                }
            }
        }
    }

    public function actionOpenAllLedByColor($colorId)
    {
        $models = Led::find()->where("status=1")->all();

//        throw new \yii\base\Exception(print_r($context, true));\]
        foreach ($models as $item) {
            foreach ($item->ledItems as $index => $led) {
                if ($led->status == 1) {
                    continue;
                }
                $color = \common\models\costfit\LedColor::find()->where("ledColorId=$colorId")->one();
                if ($color->ledColorId == $led->color) {
                    $r = $color->r;
                    $g = $color->g;
                    $b = $color->b;
                    $id = $index + 1;
//            file_get_contents('http://' . $item->ip . "/", FALSE, $context);
                    if (file_get_contents('http://' . $item->ip . "?id=$id&status=1&r=$r&g=$g&b=$b", NULL, NULL, 0, 0) !== FALSE) {
//            throw new \yii\base\Exception("?id=$id&status=$status&r=$r&g=$g&b=$b");
                        $statusText = "Turn On ";
                        $led->status = 1;
                        $led->save();
//                        echo "LED " . $item->code . " " . $statusText . $item->ip . "<br>";
                        break;
                    } else {
                        $statusText = "Turn Off ";
//                        echo "LED " . $item->code . " " . $statusText . $item->ip . $exc->getMessage();
                    }
                } else {
                    continue;
                }
            }
        }
    }

    public function actionCloseAllLed()
    {
        $models = Led::find()->where("status=1")->all();

//        throw new \yii\base\Exception(print_r($context, true));\]
        foreach ($models as $item) {
            foreach ($item->ledItems as $index => $led) {
                if ($led->status == 0) {
                    continue;
                }
                $id = $index + 1;
//            file_get_contents('http://' . $item->ip . "/", FALSE, $context);
                if (file_get_contents('http://' . $item->ip . "?id=$id&status=0", NULL, NULL, 0, 0) !== FALSE) {
//            throw new \yii\base\Exception("?id=$id&status=$status&r=$r&g=$g&b=$b");
                    $statusText = "Turn Off ";
                    $led->status = 0;
                    $led->save();
//                    echo "LED " . $item->code . " " . $statusText . $item->ip . "<br>";
                } else {
                    $statusText = "Turn On ";
//                    echo "LED " . $item->code . " " . $statusText . $item->ip . $exc->getMessage();
                }
            }
        }
    }

    public function actionCloseAllLedByColor($colorId)
    {
        $models = Led::find()->where("status=1")->all();

//        throw new \yii\base\Exception(print_r($context, true));\]
        foreach ($models as $item) {
            foreach ($item->ledItems as $index => $led) {
                if ($led->status == 0) {
                    continue;
                }
                $color = \common\models\costfit\LedColor::find()->where("ledColorId=$colorId")->one();
                if ($color->ledColorId == $led->color) {
                    $r = $color->r;
                    $g = $color->g;
                    $b = $color->b;
                    $id = $index + 1;
//            file_get_contents('http://' . $item->ip . "/", FALSE, $context);
                    if (file_get_contents('http://' . $item->ip . "?id=$id&status=0&r=$r&g=$g&b=$b", NULL, NULL, 0, 0) !== FALSE) {
//            throw new \yii\base\Exception("?id=$id&status=$status&r=$r&g=$g&b=$b");
                        $statusText = "Turn Off ";
                        $led->status = 0;
                        $led->save();
//                        echo "LED " . $item->code . " " . $statusText . $item->ip . "<br>";
                        break;
                    } else {
                        $statusText = "Turn On ";
//                        echo "LED " . $item->code . " " . $statusText . $item->ip . $exc->getMessage();
                    }
                } else {
                    continue;
                }
            }
        }
    }

}
