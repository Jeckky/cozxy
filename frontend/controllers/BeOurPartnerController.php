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

/**
 * Description of BeOurPartner
 *
 * @author it
 */
class BeOurPartnerController extends MasterController {

    //put your code here
    public function actionIndex() {
        $modelUser = new \common\models\costfit\User(['scenario' => 'shipping_address']);
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
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
        return $this->render('index', compact('model', 'hash', 'modelUser'));
    }

}
