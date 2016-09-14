<?php

namespace backend\modules\led\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\controllers\MasterController;
use common\models\costfit\master;
use common\models\costfit;

/**
 * Store controller
 */
class LedItemMasterController extends \backend\controllers\BackendMasterController {

    public $breadcrumbs = [];
    public $layout = '/cl1';
    public $nav = [];
    public $title = 'Title';
    public $subTitle = 'Sub Title';

    public function writeToFile($fileName, $string, $mode = 'w+') {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }

    public function saveModelLang($mainModel, $langModel) {
        $result = [];
        $langClassName = (new \ReflectionClass($langModel))->getShortName();
        $mainModelClassName = (new \ReflectionClass($mainModel))->getShortName();
        $oldModel = $langModel;
        $result["status"] = FALSE;
        $result["errorMessage"] = "Can't not find language model";
//        throw new \yii\base\Exception(print_r($_POST[$langClassName], true));
        if (isset($_POST[$langClassName])) {
            foreach ($_POST[$langClassName] as $index => $v) {
                $newModel = $langModel->find()->where("languageId =" . $_POST[$langClassName][$index]["languageId"] . " AND " . lcfirst($mainModelClassName) . "Id =" . $_POST[$langClassName][$index][lcfirst($mainModelClassName) . "Id"])->one();

                if (!isset($newModel)) {

                    $langModel = new $oldModel();
                    $langModel->createDateTime = new \yii\db\Expression('NOW()');
                } else {
//                    throw new \yii\base\Exception(222);
                    $langModel = $newModel;
                }

                $langModel->attributes = $_POST[$langClassName][$index];
//                throw new \yii\base\Exception(print_r($langModel->attributes, true));
//                $langModel->{lcfirst($mainModelClassName) . "Id"} = $_POST[$langClassName][$index][$mainModelClassName . "Id"];

                foreach ($langModel->getAttributes() as $k => $attri) {
//                $columns[$n]['name'] = $langModel->getTableSchema()->columns[$k]->name;
//                $columns[$n]['type'] = $langModel->getTableSchema()->columns[$k]->type;
//                $columns[$n]['size'] = $langModel->getTableSchema()->columns[$k]->size;
                    if ($langModel->getTableSchema()->columns[$k]->size == 255) {

                        $fileObj = \yii\web\UploadedFile::getInstanceByName($langClassName . "[" . $index . "][" . $langModel->getTableSchema()->columns[$k]->name . "]");
                        if (isset($fileObj) && !empty($fileObj)) {

                            $folderName = lcfirst($langClassName);
                            $file = $fileObj->name;
                            $filenameArray = explode('.', $file);
                            $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                            $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                            $urlFile = $urlFolder . $fileName;
                            $langModel->{$langModel->getTableSchema()->columns[$k]->name} = '/' . 'images/' . $folderName . "/" . $fileName;
                            if (!file_exists($urlFolder)) {
//                                throw new \yii\base\Exception($urlFolder);
                                mkdir($urlFolder, 0777);
                            }
                            //                            throw new \yii\base\Exception(print_r($langModel->attributes, true));
                        } else {
                            if (isset($_POST[$langClassName][$index][$langModel->getTableSchema()->columns[$k]->name . "Old"]) && !empty($_POST[$langClassName][$index][$langModel->getTableSchema()->columns[$k]->name . "Old"])) {
                                $langModel->{$langModel->getTableSchema()->columns[$k]->name} = $_POST[$langClassName][$index][$langModel->getTableSchema()->columns[$k]->name . "Old"];
                            } else {
                                $langModel->{$langModel->getTableSchema()->columns[$k]->name} = null;
                            }
                        }
                    }
                }
                if ($langModel->save()) {
                    if (isset($fileObj) && !$fileObj->saveAs($urlFile)) {
//                        throw new \yii\base\Exception(111);
                        $result["status"] = FALSE;
                        $result["errorMessage"] = "Can't Save Image";
                        return FALSE;
                    } else {
                        $result["status"] = TRUE;
                    }
                }
//            else {
//                    $result["status"] = FALSE;
//                    $result["errorMessage"] = "Can't Save Lang";
//                }
            }
        }
        return $result;
    }

}
