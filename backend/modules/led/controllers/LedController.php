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
class LedController extends LedMasterController {

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
     * Lists all Led models.
     * @return mixed
     */
    public function actionIndex() {
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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Led model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
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

    public function actionIndexColor() {
        $model = \common\models\costfit\LedColor::find()->all();
        return $this->render('index_color', [
                    'model' => $model,
        ]);
    }

    public function actionCreateColor() {
        $model = new \common\models\costfit\LedColor();
        $r = 0;
        $b = 0;
        $g = 0;
        if (isset($_POST['LedColor'])) {
            // throw new \yii\base\Exception('a');
            if (isset($_POST['LedColor']['r']) && !empty($_POST['LedColor']['r'])) {
                $r = $_POST['LedColor']['r'];
            }if (isset($_POST['LedColor']['b']) && !empty($_POST['LedColor']['b'])) {
                $b = $_POST['LedColor']['b'];
            }if (isset($_POST['LedColor']['g']) && !empty($_POST['LedColor']['g'])) {
                $g = $_POST['LedColor']['g'];
            }
            //throw new \yii\base\Exception($b);
            $r = $r * 7;
            $g = $g * 7;
            $b = $b * 7;
            if ($r > 255) {
                $r = 255;
            }if ($g > 255) {
                $g = 255;
            }
            if ($b > 255) {
                $b = 255;
            }
            $rgb = array($r, $g, $b);
            $hex = $this->rgb2hex($rgb);
            $oldColor = \common\models\costfit\LedColor::find()->where("1 order by ledColor DESC")->one();
            if (isset($oldColor)) {
                $ledColorId = $oldColor->ledColor + 1;
            } else {
                $ledColorId = 1;
            }
            $model->ledColor = $ledColorId;
            $model->htmlCode = $hex;
            $model->r = $_POST['LedColor']['r'];
            $model->g = $_POST['LedColor']['g'];
            $model->b = $_POST['LedColor']['b'];
            $model->status = 1;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(false)) {
                return $this->redirect('index-color');
            } else {
                return $this->render('create_color', [
                            'r' => $_POST['LedColor']['r'],
                            'g' => $_POST['LedColor']['g'],
                            'b' => $_POST['LedColor']['b'],
                            'model' => $model,
                ]);
            }
        }
        return $this->render('create_color', [
                    'model' => $model,
        ]);
    }

    public static function rgb2hex($rgb) {
        $hex = "#";
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex;
    }

    /**
     * Updates an existing Led model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdateColor($id) {
        $model = \common\models\costfit\LedColor::find()->where("ledColorId=" . $id)->one();
        $r = 0;
        $b = 0;
        $g = 0;
        if (isset($model)) {
            if (isset($_POST['LedColor'])) {
                // throw new \yii\base\Exception('a');
                if (isset($_POST['LedColor']['r']) && !empty($_POST['LedColor']['r'])) {
                    $r = $_POST['LedColor']['r'];
                }if (isset($_POST['LedColor']['b']) && !empty($_POST['LedColor']['b'])) {
                    $b = $_POST['LedColor']['b'];
                }if (isset($_POST['LedColor']['g']) && !empty($_POST['LedColor']['g'])) {
                    $g = $_POST['LedColor']['g'];
                }
                //throw new \yii\base\Exception($b);
                $rgb = array($r, $g, $b);
                $hex = $this->rgb2hex($rgb);
                $oldColor = \common\models\costfit\LedColor::find()->where("1 order by ledColor DESC")->one();
                if (isset($oldColor)) {
                    $ledColorId = $oldColor->ledColor + 1;
                } else {
                    $ledColorId = 1;
                }
                $model->ledColor = $ledColorId;
                $model->htmlCode = $hex;
                $model->r = $r;
                $model->g = $g;
                $model->b = $b;
                $model->status = 1;
                $model->createDateTime = new \yii\db\Expression('NOW()');
                if ($model->save(false)) {
                    return $this->redirect('index-color');
                } else {
                    return $this->render('create_color', [
                                'r' => $r,
                                'g' => $g,
                                'b' => $b,
                                'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create_color', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('index_color', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
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
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        $items = \common\models\costfit\LedItem::find()->where("ledId=" . $id)->all();
        foreach ($items as $item) {
            $item->delete();
        }
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        return $this->redirect($baseUrl . '/led/led');
    }

    public function actionDeleteColor($id) {
        $items = \common\models\costfit\LedColor::find()->where("ledColorId=" . $id)->one();
        if (isset($items)) {
            $items->delete();
        }
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        return $this->redirect($baseUrl . '/led/led/index-color');
    }

    /**
     * Finds the Led model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Led the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Led::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    function chekIp($ip) {
        $led = Led::find()->where("ip='" . $ip . "'")->all();
        if (isset($led) and ! empty($led)) {
            return true;
        } else {
            return false;
        }
    }

    public function actionChangeStatus($id) {
        $model = Led::find()->where("ledId=$id")->one();
        $model->status = $_GET["status"];
        if ($model->save()) {
            return $this->redirect('index');
        }
    }

    public function actionOpenAllLed() {
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

    public function actionOpenAllLedByColor($colorId) {
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

    public function actionCloseAllLed() {
        $models = Led::find()->where("status=1")->all();

//        throw new \yii\base\Exception(print_r($context, true));\]
        foreach ($models as $item) {
            foreach ($item->ledItems as $index => $led) {
                if ($led->status == 0) {
                    continue;
                }
                $id = $index + 1;
//            file_get_contents('http://' . $item->ip . "/", FALSE, $context);
                if (ile_get_contents('http://' . $item->ip . "?id=$id&status=0", NULL, NULL, 0, 0) !== FALSE) {
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

    public function actionCloseAllLedByColor($colorId) {
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

    public function actionOpenLed($slot, $colorId) {
        $models = Led::find()->where("status=1 AND slot in($slot)")->all();
        foreach ($models as $item) {

            foreach ($item->ledItems as $index => $led) {
                $color = \common\models\costfit\LedColor::find()->where("ledColorId=$colorId")->one();
                if ($color->ledColorId == $led->color) {
                    $r = $color->r;
                    $g = $color->g;
                    $b = $color->b;
                    $id = $index + 1;
                    if (file_get_contents('http://' . $item->ip . "?id=$id&status=1&r=$r&g=$g&b=$b", NULL, NULL, 0, 0) !== FALSE) {
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
        $slotArray = explode(",", $slot);
        foreach ($slotArray as $s) {
            $s = str_replace("'", "", $s);
            $this->checkShelfLed($s, $colorId, 1);
        }
    }

    public function actionCloseLed($slot, $colorId) {
        $item = Led::find()->where("status=1 AND slot='$slot'")->one();

        //throw new \yii\base\Exception(print_r($item->ledId, true));
        foreach ($item->ledItems as $index => $led) {
            $color = \common\models\costfit\LedColor::find()->where("ledColorId=$colorId")->one();
            if ($color->ledColorId == $led->color) {
                $r = $color->r;
                $g = $color->g;
                $b = $color->b;
                $id = $index + 1;
                if (file_get_contents('http://' . $item->ip . "?id=$id&status=0&r=$r&g=$g&b=$b", NULL, NULL, 0, 0) !== FALSE) {
                    $statusText = "Turn Off ";
                    $led->status = 0;
                    $led->save();
                    break;
                } else {
                    $statusText = "Turn On ";
                }
            } else {
                continue;
            }
        }
        $this->checkShelfLed($slot, $colorId, 0);
    }

    public function actionGetLastState($ip) {
        $result = [];
        $model = Led::find()->where("status=1 AND ip='$ip'")->one();
        $ledItems = \common\models\costfit\LedItem::find()->where("ledId=$model->ledId")->orderBy("sortOrder ASC")->all();
        foreach ($ledItems as $index => $led) {
            $color = \common\models\costfit\LedColor::find()->where("ledColorId=$led->color")->one();
            $result[] = ["id" => $index + 1, "status" => $led->status, "r" => $color->r, "g" => $color->g, "b" => $color->b];
        }
        echo json_encode($result);
    }

    public function checkShelfLed($slot, $colorId, $status) {
        if (strlen($slot) == 2) {
            $code = $slot;
        } else {
            $code = substr($slot, 0, 2);
        }
        $model = Led::find()->where("status=1 AND slot='$code'")->one();
        if (isset($model->ledItems) && count($model->ledItems) > 0) {
            foreach ($model->ledItems as $index => $item) {
                $id = $index + 1;
                if ($colorId != $item->color) {
                    continue;
                } else {
                    if ($status) {
                        $color = \common\models\costfit\LedColor::find()->where("ledColorId=$colorId")->one();
                        $r = $color->r;
                        $g = $color->g;
                        $b = $color->b;
                        file_get_contents('http://' . $model->ip . "?id=$id&status=1&r=$r&g=$g&b=$b", NULL, NULL, 0, 0);
                        $item->status = 1;
                        $item->save();
                    } else {
                        $countOpenLed = \common\models\costfit\LedItem::find()
                                ->join("LEFT JOIN", "led l", "led_item.ledId=l.ledId")
                                ->where("l.slot LIKE '$code%' AND l.slot != '$code' AND led_item.status = 1")
                                ->count();
                        if ($countOpenLed == 0) {
                            file_get_contents('http://' . $model->ip . "?id=$id&status=0", NULL, NULL, 0, 0);
                            $item->status = 0;
                            $item->save();
                        }
                    }
                }
            }
        }
    }

}
