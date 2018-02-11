<?php

namespace backend\modules\mailstore\controllers;

use Yii;
use common\models\costfit\Section;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\SectionItem;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
use common\helpers\Email;

/**
 * SectionController implements the CRUD actions for Section model.
 */
class VerifyEmailController extends MailStoreMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
// 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Section models.
     * @return mixed
     */
    public function actionIndex() {
        $NotVerify = User::find()->where('status=0')->count();
        $query = User::find()->where("status = 0");
        if (isset($_GET["searchEmail"]) && $_GET["searchEmail"] != '') {
//throw new \yii\base\Exception('123456');
            $query->andWhere("email like '%" . $_GET["searchEmail"] . "%' or username like '%" . $_GET["searchEmail"] . "%' or firstname like '%" . $_GET["searchEmail"] . "%'");
            $NotVerify = User::find()->where("status=0 and (email like '%" . $_GET["searchEmail"] . "%' or username like '%" . $_GET["searchEmail"] . "%' or firstname like '%" . $_GET["searchEmail"] . "%')")->count();
        }
        $query->orderBy("password DESC,createDateTime DESC");
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'NotVerify' => $NotVerify,
        ]);
    }

    public function actionPrepareAction() {
//throw new \yii\base\Exception($_POST["submitType"]);
        if (isset($_POST["user"])) {
            if ($_POST["submitType"] == 'verify') {
                foreach ($_POST["user"] as $userId => $mail):
                    $this->sendEmail($mail, $userId);
                endforeach;
                $this->redirect('index');
            }
            if ($_POST["submitType"] == 'delete') {
                foreach ($_POST["user"] as $userId => $mail):
                    $this->deleteUser($userId);
                endforeach;
            }
        } else {
            $this->redirect('index');
        }
    }

    public function sendEmail($email, $userId) {
        $user = User::find()->where("userId=$userId")->one();
        if (isset($user)) {
            $url = "http://" . Yii::$app->request->getServerName() . "/site/confirm?token=" . $user->token;
            $emailSend = Email::mailRegisterConfirmBooth($email, $url);
        }
    }

    public function deleteUser($userId) {
        $user = User::find()->where("userId=$userId")->one();
        if (isset($user)) {
            $user->delete();
        }
        $this->redirect('index');
    }

    /**
     * Displays a single Section model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Section model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

    }

    /**
     * Updates an existing Section model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {

    }

    /**
     * Deletes an existing Section model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Section model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Section the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Section::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionNewVerify($error = false) {
        $email = ArrayHelper::map(User::find()->where("password is not null")
                                ->asArray()
                                ->all(), 'userId', 'email');
        $user = new User();
        if (isset($error) && $error != false) {
            $errorMessage = $error;
        } else {
            $errorMessage = '';
        }
        return $this->render('messages', [
                    'email' => $email,
                    'user' => $user,
                    'errorMessage' => $errorMessage
        ]);
    }

    public function actionSendEmail() {
        $subjectPost = '';
        $messagePost = '';
        $error = 'somting wrong, Please try again.';
        if (isset($_POST["subject"]) && $_POST["subject"] != '') {
            $subjectPost = $_POST["subject"];
        }
        if (isset($_POST["message"]) && $_POST["message"] != '') {
            $messagePost = $_POST["message"];
        }
        if (isset($_POST["User"]["email"])) {
            foreach ($_POST["User"]["email"] as $userId):
                $user = User::find()->where("userId=$userId")->one();
                if (isset($user) && $user->email != null) {
                    $mailTo = $user->email;
                    $subject = $subjectPost;
                    $message = $messagePost;
                    $emailSend = Email::mailFromCozxy($mailTo, $subject, $message);
                }
            endforeach;
            $error = 'Mails send';
//throw new \yii\base\Exception(print_r($_POST["User"]["email"], true));
        }
        $this->redirect(['new-verify', 'error' => $error]);
    }

    public function actionAllUser() {
        $res = [];
        $user = User::find()->where("status = 0")->all();
        if (isset($_GET["searchEmail"]) && $_GET["searchEmail"] != '') {
            $user = User::find()->where("status=0 and (email like '%" . $_GET["searchEmail"] . "%' or username like '%" . $_GET["searchEmail"] . "%' or firstname like '%" . $_GET["searchEmail"] . "%')")->count();
        }
        if (isset($user) && count($user) > 0) {
            $i = 0;
            foreach ($user as $id):
                $res["userId"][$i] = $id->userId;
                $i++;
            endforeach;
            $res["status"] = true;
            $res["count"] = count($user);
        }else {
            $res["status"] = false;
        }
        return json_encode($res);
    }

}
