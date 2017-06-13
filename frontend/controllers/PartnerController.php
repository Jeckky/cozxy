<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\DisplayMyAccount;
use common\helpers\CozxyUnity;

/**
 * Description of PartnerControllers
 *
 * @author it
 */
class PartnerController extends MasterController {

    //put your code here
    public function actionIndex() {
        return $this->render('index');
    }

    //put your code here
    public function actionPartnerMembershipRegistration() {
        $modelUser = new \common\models\costfit\User(['scenario' => 'shipping_address']);
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        $modelFile = new \common\models\costfit\AddressPartnerFile(['scenario' => 'shipping_address']);
        /* if (isset($_POST['Address'])) {
          $model->attributes = $_POST['Address'];
          if ($_POST["Address"]['isDefault']) {
          \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
          $model->isDefault = 1;
          }
          $model->userId = Yii::$app->user->id;
          $model->type = \common\models\costfit\Address::TYPE_BILLING;
          $model->createDateTime = new \yii\db\Expression("NOW()");
          if ($model->save(FALSE)) {
          return $this->redirect(['/my-account']);
          }
          }
          if (!isset($model->isDefault)) {
          $model->isDefault = 0;
          } */
        $hash = 'add';
        $historyBirthDate = [];
        $birthdate = [];

        $historyBirthDate['day'] = FALSE;
        $historyBirthDate['month'] = FALSE;
        $historyBirthDate['year'] = FALSE;

        $birthdate['dates'] = CozxyUnity::getDates($historyBirthDate['day']);
        $birthdate['month'] = CozxyUnity::getMonthEn($historyBirthDate['month']);
        $birthdate['years'] = CozxyUnity::getYears($historyBirthDate['year']);
        return $this->render('be-our-partner', compact('model', 'hash', 'modelUser', 'birthdate', 'historyBirthDate', 'modelFile'));
    }

}
