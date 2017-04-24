<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\costfit\Category;
use common\models\costfit\Content;
use common\models\costfit\ContentGroup;

/**
 * Site controller
 */
class SiteController extends MasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
//        throw new \yii\base\Exception(print_r(\Yii::$app->user->identity, true));
        $this->title = 'My Cozxy.com';
        $bannerGroup = ContentGroup::find()->where("lower(title) = 'banner' and status=1")->one();
        $topOne = ContentGroup::find()->where("lower(title)='topOne'")->one();
        $topOneContent = Content::find()->where("contentGroupId='" . $topOne->contentGroupId . "' order by contentId DESC limit 0,1")->one();
        $bottomIndexGroup = ContentGroup::find()->where("lower(title)='bottomIndex'")->one();
        $bottomContent = Content::find()->where("contentGroupId='" . $bottomIndexGroup->contentGroupId . "'")->all();
        $lastIndexGroup = ContentGroup::find()->where("lower(title)='lastIndex'")->one();
        $lastIndexContent = Content::find()->where("contentGroupId='" . $lastIndexGroup->contentGroupId . "' order by contentId DESC limit 0,1")->one();
        //$product = \common\models\costfit\search\Product::bestSellers();
        $product = \common\models\costfit\ProductSuppliers::bestSellers();
        //$product2 = \common\models\costfit\search\Product::itemOnSales();
        $product2 = \common\models\costfit\ProductSuppliers::itemOnSales();
        $hotProducts = \common\models\costfit\search\Product::hotProducts();
        $saveCat = Category::findAllSaveCategory();
        $popularCat = Category::findAllPopularCategory();
        $hotProduct = \common\models\costfit\ProductHot::findAllHotProducts();
        //$footer = "adfadf";
        $productPost = \common\models\costfit\ProductPost::find()->groupBy(['productSuppId'])->orderBy('productPostId desc')->limit(4)->all();
        $productCanSell = new \yii\data\ActiveDataProvider([
            'query' => \common\models\costfit\ProductSuppliers::find()->where('approve="approve" and result > 0 and RAND() order by productSuppId DESC'), 'pagination' => [
                'pageSize' => 4,
            ],
        ]);


        $NotSell = \common\models\costfit\ProductSuppliers::find()->where('result = 0 and  approve="approve" and RAND() order by productSuppId DESC');
        $productNotSell = new \yii\data\ActiveDataProvider([
            'query' => $NotSell, 'pagination' => [
                'pageSize' => 4,
            ],
        ]);

        return $this->render('index', compact('productNotSell', 'productCanSell', 'productPost', 'saveCat', 'popularCat', 'bannerGroup', 'topOneContent', 'bottomContent', 'lastIndexContent', 'product', 'product2', 'footer', 'hotProduct'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRegister() {
        return $this->render('register');
    }

    public function successCallback($client) {
        $attributes = $client->getUserAttributes();
        $auth_type = '';
        // throw new \yii\base\Exception(print_r($attributes, true));
        if ($_GET['authclient'] == 'facebook') {
            //facebook
            $email = isset($attributes['email']) ? $attributes['email'] : '-';
            $name = explode(' ', $attributes['name']);
            $fName = current($name);
            $lName = end($name);
            $auth_type = 'facebook';
        } else if ($_GET['authclient'] == 'google') {
            //google
            $fName = $attributes['name']['givenName'];
            $lName = $attributes['name']['familyName'];
            $email = isset($attributes['emails'][0]['value']) ? $attributes['emails'][0]['value'] : '-';
            $auth_type = 'google';
        }
        if ($email == '-') {
            $ms = 1;
            $this->redirect(['register/register', 'ms' => $ms]);
        } else {
            $user = \common\models\costfit\User::find()->where(['email' => $email])->one();
            if (!empty($user)) {
                $login = new LoginForm();
                if ($user->status == 0) {
                    // กรณี status = 0 http://localhost/Cozxy.com-frontend/register/thank
                    $status = 1;
                    $this->redirect(['register/thank', 'status' => $status]);
                } else {
                    $type = $auth_type;
                    $flag = FALSE;
                    $typeLogin = explode(",", $user->auth_type);
                    foreach ($typeLogin as $logins) {
                        if ($logins == $type) {//เคย login ด้วย email นี้ social นี้ หรือไม่
                            $flag = TRUE;
                        }
                    }
                    if (!$flag) {//ถ้าไม่เคย
                        if ($user->auth_type == '') {
                            $user->auth_type = $type;
                        } else {
                            $user->auth_type = $user->auth_type . "," . $type;
                        }
                        $user->save();
                    }
                    $login->login2($user);
                }
            } else {
                $model = new \common\models\costfit\User(['scenario' => 'register']);
                $model->username = $model->email = $email;
                $model->firstname = $fName;
                $model->lastname = $lName;
                //$model->auth_type = $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $model->password = $attributes['id'];
                $model->auth_key = $model->password_hash = Yii::$app->security->generatePasswordHash($attributes['id']);
                $model->auth_type = $auth_type;
                $model->status = 1;
                $model->token = Yii::$app->security->generateRandomString(10);
                $model->createDateTime = new \yii\db\Expression("NOW()");
                $model->save(false);
                $login = new LoginForm();
                $user = \common\models\costfit\User::find()->where(['email' => $email])->one();
                $login->login2($user);
            }
        }
    }

    public function actionSaveAppend() {
//$saveCat = Category::findAllSaveCategory();
        $ids = implode(",", $_POST['ids']);
        $html = '<div id="products-save-cat" class="category col-lg-2 col-md-2 col-sm-4 col-xs-6"> </div>';
        $categoryId = Yii::$app->request->post('categoryId');
        $query = Category::find()
        ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
        ->where('sc.type = 1 and sc.categoryId not in(' . $ids . ")")
        ->limit(6)
        ->all();

        $i = 0;

        foreach ($query as $key => $value) {

            if (count($value->image) > 0) {
                $url_image = $value->image;
            } else {
                $url_image = '/images/ContentGroup/DUHWYsdXVc.png';
            }

            if ($i == 0) {
                $html = "";
            } else {
                $html .= '<div id="products-save-cat" class="category col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <input type="hidden" id="seeMoreId" value="' . $value->categoryId . '">
                        <a href="' . Yii::$app->homeUrl . 'search/' . $value->createTitle() . '/' . $value->encodeParams(['categoryId' => $value->categoryId]) . '">
                        <img src="' . Yii::$app->homeUrl . $url_image . '" alt="1">
                        <p>' . $value->title . '</p>
                        </a>
                     </div>';
            }

            $i++;
        }
        echo $html;
        //echo '<pre>';
        // print_r($query);
        //return json_encode($query);
    }

    public function actionReviews() {
        $productSuppId = Yii::$app->request->post('productSuppId');
        $productImageId = Yii::$app->request->post('productImageId');
        $reviews = \common\models\costfit\ProductPost::find()
        ->select('product_post.productPostId, product_post.productSuppId,user.username ,product_post_rating.score, product_post.description ,product_post.createDateTime')
        ->join("LEFT JOIN", 'user', 'user.userId = product_post.userId')
        ->join("LEFT JOIN", 'product_post_rating', 'product_post_rating.productPostId = product_post.productPostId')
        ->where('product_post.productSuppId=' . $productSuppId)
        ->all();

        return \yii\helpers\Json::encode($reviews);
    }

}
