<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use common\models\costfit\Content;
use common\models\costfit\ContentGroup;
use common\helpers\Email;
use common\helpers\CozxyUnity;

class BoothController extends MasterController {

    public function actionIndex() {
        //$model_verdifile = new \common\models\costfit\User(['scenario' => 'register']);
        $contentGroup = ContentGroup::find()->where("lower(title)='term'")->one();
        if (isset($contentGroup)) {
            $content = Content::find()->where("contentGroupId=" . $contentGroup->contentGroupId)->one();
        } else {
            $content = FALSE;
        }
        $dd = '';
        $mm = '';
        $yyyy = '';

        $model = new SignupForm(['scenario' => 'registerBooth']);

        if (isset($_POST["SignupForm"])) {

            //print_r($_POST["SignupForm"]);
            if ($model->load(Yii::$app->request->post())) {
                $model->attributes = $_POST["SignupForm"];
                $model->birthDate = '' . '-' . '' . '-' . '';
                $model->group = 'booth';

                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        //return $this->redirect(Yii::$app->homeUrl . 'site/thank' . '?token=' . $user->attributes['token']);
                        return $this->redirect(Yii::$app->homeUrl . 'booth/confirm' . '?token=' . $user->attributes['token']);
                        // http://cozxy.com/booth/confirm?token=F80-SBgXV9
                    } else {
                        //echo 'xx';
                    }
                }
            } else {

            }
        } else {

        }
        return $this->render('@app/themes/cozxy/layouts/_register_booth', [
                    'model' => $model, 'content' => $content
        ]);
    }

    public function actionConfirm() {
        $token = '';
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $model = \common\models\costfit\User::find()->where('token ="' . $token . '" ')->one();
        } else {
            $model = new \common\models\costfit\User();
            $model->scenario = 'ConfirmRegisterBooth'; // calling scenario of update
        }

        if (isset($_POST["User"])) {
            $editChangePassword = \frontend\models\DisplayMyAccount::ConfirmRegisterBooth($_POST['User']['password'], $token, $_POST['User']['email']);
            if ($editChangePassword == TRUE) {
                return $this->redirect(['/site/login']);
            } else {
                if ($token != '') {
                    if ($editChangePassword == TRUE) {
                        return $this->redirect(['/booth/confirm?token=' . $token]);
                    } else {
                        $model->attributes = $_POST["User"];
                        $model->email = $_POST["User"]['email'];
                        $model->password = $_POST["User"]['password'];
                        $model->addError('password', 'Incorrect OTP');
                        //return $this->redirect(['/booth/confirm?token=' . $token]);
                        return $this->render('booth-confirm', compact('model'));
                    }
                } else {
                    $model->attributes = $_POST["User"];
                    $model->email = $_POST["User"]['email'];
                    $model->password = $_POST["User"]['password'];
                    $model->addError('password', 'Incorrect OTP');
                    return $this->render('booth-confirm', compact('model'));
                }
            }
        } else {
            return $this->render('booth-confirm', compact('model'));
        }
    }

}
