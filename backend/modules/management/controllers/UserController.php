<?php

namespace backend\modules\management\controllers;

use Yii;
use common\models\costfit\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\Upload;
use hscstudio\mimin\models\AuthAssignment;
use hscstudio\mimin\models\AuthItem;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ManagementMasterController
{

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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (isset($_POST["type"]) && $_POST["type"] != 0) {
            $query = User::find()->where("type = " . $_POST["type"])->orderBy("type ASC");
        } else {
            $query = User::find()->orderBy("type ASC");
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {

        $modelUser = $this->findModel($id);

        $authAssignments = AuthAssignment::find()->where([
            'user_id' => $modelUser->userId,
        ])->column();

        $authItems = \yii\helpers\ArrayHelper::map(
        AuthItem::find()->where([
            'type' => 1,
        ])->asArray()->all(), 'name', 'name');

        $authAssignment = new AuthAssignment([
            'user_id' => $modelUser->userId,
        ]);
        //echo $modelUser->user_group_Id;
        $CheckuserGroup = str_replace('[', '', str_replace(']', '', $modelUser->user_group_Id));

        if ($CheckuserGroup != '') {
            $userGroupx = str_replace('[', '(', str_replace(']', ')', $modelUser->user_group_Id));
            // echo $userGroupx;
            /*
              $result = \common\models\costfit\UserGroups::find()
              ->select('group_concat(name) as name , group_concat(user_group_Id) as user_group_Id')
              ->where("user_group_Id in " . $userGroupx . "  ")
              ->one();
             * */
        } else {
            $result = NULL;
        }

        $query = '';
        $listViewLevels = new ActiveDataProvider([
            'query' => \common\models\costfit\UserGroups::find(),
        ]);

        $listMenu = new ActiveDataProvider([
            'query' => \common\models\costfit\Menu::find(),
        ]);

        //echo '<pre>';
        // print_r($listMenu);
        $authAssignment->item_name = $authAssignments;
        return $this->render('view', [
            'model' => $this->findModel($id), 'listViewLevels' => $listViewLevels, 'listMenu' => $listMenu, 'authAssignment' => $authAssignment,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new User(['scenario' => 'user_backend']);

        if (isset($_POST["User"])) {

            $model = \common\models\costfit\User::find()->where('email = "' . $_POST["User"]['email'] . '" ')->one();
            if (isset($model)) {
                $model->attributes = $_POST["User"];
                //echo 'มี Emial นี้แล้ว !!';
                //echo CHtml::errorSummary($model->email);
                //$form = \kartik\form\ActiveForm::begin();
                //echo $form->errorSummary($model, ['header' => '']);
                //\kartik\form\ActiveForm::end();
                //echo $CheckEmail->addError('email', 'Email already exists');
                $model->addError('email', 'Email นี้มีในระบบแล้ว');
            } else {
                $model = new User(['scenario' => 'user_backend']);
                $model->attributes = $_POST["User"];
                $model->status = 1;
                $model->auth_type = 'Backend';
                $model->username = $_POST["User"]['email'];
                $model->code = $_POST["User"]['code'];
                $model->passportNo = $_POST["User"]['passportNo'];
                /*
                 * Upload ครั้งละรูป
                 * helpers Upload
                 * path : common/helpers/Upload.php
                 * use : Upload::uploadBasic($fileName, $folderName, $uploadPath, $width, $height)
                 */
                //$folderName = "passport"; //  Size 553 x 484
                //$uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
                //$newFileName = Upload::UploadBasic('User[passportImage]', $folderName, $uploadPath, '300', '300');

                $imageObj = \yii\web\UploadedFile::getInstanceByName("User[passportImage]");
                if (isset($imageObj) && !empty($imageObj)) {
                    $newFileName = Upload::UploadBasic('User[passportImage]', $folderName, $uploadPath, '300', '300');
                    $model->passportImage = '/' . 'images/' . $folderName . "/" . $newFileName;
                } else {
                    echo 'No';
                }



                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $model->token = Yii::$app->security->generateRandomString(10);
                $model->createDateTime = new \yii\db\Expression("NOW()");
                $model->lastvisitDate = new \yii\db\Expression("NOW()");
                if ($model->save(FALSE)) {
                    //return $this->redirect(['index']);
                    return $this->redirect(Yii::$app->homeUrl . 'management/address/create?userId=' . $model->userId);
                }
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST["User"])) {
            $model->attributes = $_POST["User"];
            /*
             * Upload ครั้งละรูป
             * helpers Upload
             * path : common/helpers/Upload.php
             * use : Upload::uploadBasic($fileName, $folderName, $uploadPath, $width, $height)
             */
            $folderName = "passport"; //  Size 553 x 484
            $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
            $newFileName = Upload::UploadBasic('User[passportImage]', $folderName, $uploadPath, '300', '300');
            $model->passportImage = isset($newFileName) ? '/' . 'images/' . $folderName . "/" . $newFileName : NULL;
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Access an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param
     * @return
     */
    public function actionGroup($id)
    {
        $model = $this->findModel($id);
//        if (isset($_POST["ViewLevels"])) {
//            $model->attributes = $_POST["ViewLevels"];
//            if (isset($_POST["ViewLevels"]['user_group_Id'])) {
//                $rules = '';
//                foreach ($_POST["ViewLevels"]['user_group_Id'] as $value) {
//                    $rules .= $value . ',';
//                }
//                $listRules = substr($rules, 0, -1);
//                $getRules = '[' . $listRules . ']';
//            } else {
//                $getRules = '[]';
//            }
//            $model->user_group_Id = $getRules;
//            $model->updateDateTime = new \yii\db\Expression('NOW()');
//
//            if ($model->save(FALSE)) {
//                return $this->redirect(['index']);
//            }
//        }
        $authAssignments = AuthAssignment::find()->where([
            'user_id' => $model->userId,
        ])->column();

        $authItems = \yii\helpers\ArrayHelper::map(
        AuthItem::find()->where([
            'type' => 1,
        ])->asArray()->all(), 'name', 'name');

        $authAssignment = new AuthAssignment([
            'user_id' => $model->userId,
        ]);
        if (Yii::$app->request->post()) {
//            throw new \yii\base\Exception(print_r(Yii::$app->request->post(), true));
            $authAssignment->load(Yii::$app->request->post());
            // delete all role
            AuthAssignment::deleteAll(['user_id' => $model->userId]);
            if (is_array($authAssignment->item_name)) {
                foreach ($authAssignment->item_name as $item) {
//                    if (!in_array($item, $authAssignments)) {
                    $authAssignment2 = new AuthAssignment([
                        'user_id' => $model->userId,
                    ]);
                    $authAssignment2->item_name = $item;
                    $authAssignment2->created_at = time();
                    $authAssignment2->save();

                    $authAssignments = AuthAssignment::find()->where([
                        'user_id' => $model->userId,
                    ])->column();
//                    }
                }
            }
            Yii::$app->session->setFlash('success', 'Data tersimpan');
        }

        return $this->redirect(['index', 'page' => isset($_GET["page"]) ? $_GET["page"] : 1]);
    }

    /**
     * Access an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param
     * @return
     */
    public function actionAccess($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST["Access"])) {
            $model->attributes = $_POST["Access"];
            $model->type = $_POST["Access"]['jq-validation-radios'];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                return $this->redirect(['index']);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMargin()
    {
        $title = "Supplier margin setting";
        if (isset($_GET['supplierId'])) {
            $model = \common\models\costfit\Margin::getSupplierMargin($_GET['supplierId']);
        }
        if (!isset($model)) {
            $model = new \common\models\costfit\Margin();
        }


        if (isset($_POST["Margin"]) && $_POST["Margin"]["percent"] != $model->percent) {

            $model = new \common\models\costfit\Margin();
            $model->supplierId = $_GET['supplierId'];
            $model->attributes = $_POST["Margin"];
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save()) {
                $lastId = Yii::$app->db->lastInsertID;

                \common\models\costfit\Margin::updateAll(['status' => 0], "marginId <> $lastId AND supplierId = " . $_GET['supplierId']);
                $model = \common\models\costfit\Margin::find()->where("marginId = $lastId")->orderBy("marginId DESC")->one();
            }
        }
        return $this->render('margin', [
            'model' => $model, 'title' => $title
        ]);
    }

}
