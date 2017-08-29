<?php

namespace frontend\controllers;

use common\models\costfit\Brand;
use common\models\costfit\Product;
use common\models\costfit\ProductPost;
use common\models\costfit\Subscribe;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\FakeFactory;
use common\models\costfit\Content;
use common\models\costfit\ContentGroup;
use common\helpers\Email;
use common\helpers\CozxyUnity;

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
                    'logout' => ['get'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        //echo Yii::getVersion();
        $slideGroup = new ArrayDataProvider(['allModels' => FakeFactory::productSlideGroup('', '')]);
//        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(6, FALSE)]);
        $productCanSell = Product::productForSale(6);
//        $productNotSell = new ArrayDataProvider(['allModels' => FakeFactory::productForNotSale(6)]);
        $productNotSell = Product::productForNotSale(6);
//        $productStory = new ArrayDataProvider(['allModels' => FakeFactory::productStory(3)]);
        $productStory = ProductPost::productStory(3);
//        $productBrand = new ArrayDataProvider(['allModels' => FakeFactory::productSlideBanner('', ''), 'pagination' => [
//                'pageSize' => 100,
//        ]]);
        $otherProducts = new ArrayDataProvider(['allModels' => FakeFactory::productOtherProducts()]);
//        $promotions = new ArrayDataProvider(['allModels' => FakeFactory::productPromotion(6, FALSE)]);
        $promotions = Product::productPromotion(6);
        $productBrand = Brand::allAvailableBrands();
        $slideGroup = Content::banners();

        return $this->render('index', compact('productCanSell', 'productNotSell', 'productStory', 'slideGroup', 'productBrand', 'otherProducts', 'promotions'));
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
        if (isset($_GET['cz']) && !empty($_GET['cz'])) {
            $cz = $_GET['cz'];
        } else {
            $cz = '';
        }

        $model = new LoginForm();


        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            //echo $_POST['LoginForm']['rememberMe'];
            //exit();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {

                \common\models\costfit\User::updateAll(['lastvisitDate' => new \yii\db\Expression("NOW()")], ['userId' => Yii::$app->user->identity->userId]);
                //Detect special conditions devices
                $devices = \common\helpers\GetBrowser::UserAgent();
                $article = new \common\models\costfit\UserVisit(); //Create an article and link it to the author
                $article->userId = Yii::$app->user->identity->userId;

                $article->device = $devices;
                $article->lastvisitDate = new \yii\db\Expression('NOW()');
                $article->createDateTime = new \yii\db\Expression('NOW()');
                $article->save(FALSE);

                //exit();
                //return $this->redirect(['site/index']);
                //return $this->redirect(Yii::$app->homeUrl);
                return $this->goBack();
            } else {
                //  return $this->render('login', [
                //     'model' => $model,
                //  ]);
                return $this->render('@app/themes/cozxy/layouts/_login', compact('model', 'cz'));
            }
        } else {
            return $this->render('@app/themes/cozxy/layouts/_login', compact('model', 'cz'));
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {

        Yii::$app->user->logout();
        $cookies = Yii::$app->request->cookies;
        $token = \common\helpers\Token::generateNewToken();
        /** @var \\yii2\SecureRememberMe\components\Manager $rememberMe */
        //$rememberMe = Yii::$app->rememberMe;
        //$rememberMe->delete();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        $msg = Yii::$app->request->get('msg') ? Yii::$app->request->get('msg') : '';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'msg' => $msg
            ]);
        }
    }

    public function actionContactMail() {
        $customerMail = $_POST['email'];
        $customerName = $_POST['name'];
        $customerPhone = $_POST['phone'];
        $customerMsg = $_POST['message'];
        $Subject = 'Email from customer contact';
        $mail = Email::mailContactCozxy($Subject, $customerMail, $customerName, $customerPhone, $customerMsg);
        $model = new ContactForm();
        $msg = 'You form has been sent to cozxy.com. We will contact to you shortly. Thank you.';
        return $this->redirect(['contact',
            'msg' => $msg,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {

        $contentGroup = ContentGroup::find()->where("lower(title)='lastindex'")->one();
        if (isset($contentGroup)) {
            $content = Content::find()->where("contentGroupId=" . $contentGroup->contentGroupId)->all();
        }
        return $this->render('about', [
            'content' => $content
        ]
        );
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        //$model_verdifile = new \common\models\costfit\User(['scenario' => 'register']);
        $dd = '';
        $mm = '';
        $yyyy = '';
        $ddError = '';
        $mmError = '';
        $yyyyError = '';
        $model = new SignupForm(['scenario' => 'register']);
        $contentGroup = ContentGroup::find()->where("lower(title)='term'")->one();
        if (isset($contentGroup)) {
            $content = Content::find()->where("contentGroupId=" . $contentGroup->contentGroupId)->one();
        } else {
            $content = FALSE;
        }
        $birthdate = [];
        $birthdate['dates'] = CozxyUnity::getDates(1);

        $birthdate['month'] = CozxyUnity::getMonthEn(01);
        $birthdate['years'] = CozxyUnity::getYears(1999);
        if (isset($_POST["SignupForm"])) {

            if ($model->load(Yii::$app->request->post())) {
                $model->attributes = $_POST["SignupForm"];
                if ($_POST["SignupForm"]['dd'] == '') {
                    $dd = 'Date cannot be blank.';
                    $ddError = 'has-error';
                }
                if ($_POST["SignupForm"]['mm'] == '') {
                    $mm = 'Month cannot be blank.';
                    $mmError = 'has-error';
                }
                if ($_POST["SignupForm"]['yyyy'] == '') {
                    $yyyy = 'Years cannot be blank.';
                    $yyyyError = 'has-error';
                }

                $model->birthDate = $_POST["SignupForm"]['yyyy'] . '-' . $_POST["SignupForm"]['mm'] . '-' . $_POST["SignupForm"]['dd'];
                if (isset($_GET['cz']) && !empty($_GET['cz'])) {
                    $cz = $_GET['cz'];
                } else {
                    $cz = '';
                }
                if (isset($_GET['cz']) & !empty($_GET['cz'])) {
                    $model->cz = $_GET['cz'];
                } else {
                    $model->cz = '';
                }
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        //return $this->goHome();

                        return $this->redirect(Yii::$app->homeUrl . 'site/thank' . '?token=' . $user->attributes['token']);
                    }
                }
            } else {

            }
        } else {

        }

        return $this->render('@app/themes/cozxy/layouts/_register', [
            'model' => $model, 'content' => $content, 'birthdate' => $birthdate, 'dd' => $dd, 'mm' => $mm, 'yyyy' => $yyyy, 'ddError' => $ddError, 'mmError' => $mmError, 'yyyyError' => $yyyyError
        ]);
    }

    public function actionConfirm() {
        $cz = isset($_GET['cz']) ? $_GET['cz'] : '';
        $token = isset($_GET['token']) ? $_GET['token'] : '';
        $user = \common\models\costfit\User::find()->where("token = '" . $_GET["token"] . "'")->one();
        $user->scenario = 'verification';
        $data = [];
        $data['cz'] = $cz;
        $data['token'] = $token;
        if (count($user) > 0) {
            if (isset($_POST['User']) && !empty($_POST['User'])) {
                $user->attributes = $_POST['User'];
                $token = $_POST['User']['token'];
                $cz = $_POST['User']['cz'];
                $user->status = 1;
                $user->tel = $_POST['User']['tel'];
                $user->save(FALSE);
                if (isset($cz)) {
                    return $this->redirect(Yii::$app->homeUrl . 'site/thank?verification=complete&cz=' . $cz . '&token=' . $token);
                } else {
                    return $this->redirect(Yii::$app->homeUrl . 'site/thank?verification=complete&token=' . $token);
                }
            } else {
                return $this->render('verification', [
                    'model' => $user, 'data' => $data
                ]);
            }
        } else {

            return $this->render('verification', [
                'model' => $user, 'data' => $data
            ]);
        }
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
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionFaqs() {
        $contentGroup = ContentGroup::find()->where("lower(title)='howwork2'")->one();
        if (isset($contentGroup)) {
            $content = Content::find()->where("contentGroupId=" . $contentGroup->contentGroupId)->all();
        }
        return $this->render('faqs', [
            'content' => $content
        ]);
    }

    public function actionWhyRegister() {
        return $this->render('why-register');
    }

    public function actionTermsAndConditions() {
        $contentGroup = ContentGroup::find()->where("lower(title)='term'")->one();
        if (isset($contentGroup)) {
            $content = Content::find()->where("contentGroupId=" . $contentGroup->contentGroupId)->all();
        }
        return $this->render('terms-and-conditions', [
            'content' => $content
        ]
        );
    }

    public function actionThank() {
        $token = $_GET['token'];

        $modelUser = \common\models\costfit\User::find()->where('token ="' . $token . '" ')->one();
        return $this->render('thank', compact('modelUser'));
    }

    public function actionForgetPassword() {
        $forget = $_POST['forget'];
        $user = \common\models\costfit\User::find()->where('email = "' . $forget . '  " ')->one();
        if (count($user) > 0) {
            if ($user['status'] == 1) {
                $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "site/forget-confirm?token=" . $user->token . '::' . $user->email;
                $toMail = $user->email;
                $emailSend = \common\helpers\Email::mailForgetPassword($toMail, $url);
                return TRUE;
            } else {
                return 9;
            }
        } else {
            return FALSE;
        }
    }

    public function actionForgetConfirm() {
        $forget = explode("::", $_GET['token']);
        $token = $forget[0];
        $email = $forget[1];
        $model = \common\models\costfit\User::find()->where('email = "' . $email . '" and token ="' . $token . '" ')->one();
        $model->scenario = 'profile'; // calling scenario of update
        if (isset($_POST["User"])) {
            $editChangePassword = \frontend\models\DisplayMyAccount::ForgetNewChangePassword($email, $token, $_POST["User"]);
            if ($editChangePassword == TRUE) {
                return $this->redirect(['/site/login']);
            } else {
                return $this->redirect(['/site/login']);
            }
        } else {
            return $this->render('forget-password', compact('model'));
        }
    }

    public function actionSeeAllPromotions() {
//        $slideGroup = new ArrayDataProvider(['allModels' => FakeFactory::productSlideGroup('', '')]);
//        $productStory = new ArrayDataProvider(['allModels' => FakeFactory::productStory(3)]);
//        $productBrand = new ArrayDataProvider(['allModels' => FakeFactory::productSlideBanner('', '')]);
        $otherProducts = new ArrayDataProvider(['allModels' => FakeFactory::productOtherProducts()]);
//        $promotions = new ArrayDataProvider(['allModels' => FakeFactory::productPromotion(), 'pagination' => ['defaultPageSize' => 15],]);
        $promotions = Product::productPromotion();

        return $this->render('index', compact('otherProducts', 'promotions'));
    }

    public function actionSeeAllSale() {
//        $slideGroup = new ArrayDataProvider(['allModels' => FakeFactory::productSlideGroup('', '')]);
//        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(), 'pagination' => ['defaultPageSize' => 15],]);
//        $productStory = new ArrayDataProvider(['allModels' => FakeFactory::productStory(3)]);
//        $productBrand = new ArrayDataProvider(['allModels' => FakeFactory::productSlideBanner('', '')]);
        $otherProducts = new ArrayDataProvider(['allModels' => FakeFactory::productOtherProducts()]);
        $productCanSell = Product::productForSale();

        return $this->render('index', compact('productCanSell', 'productNotSell', 'productStory', 'slideGroup', 'productBrand', 'otherProducts', 'promotions'));
    }

    public function actionSeeAllNotSale() {
        $productNotSell = Product::productForNotSale();
        $otherProducts = new ArrayDataProvider(['allModels' => FakeFactory::productOtherProducts()]);

        return $this->render('index', compact('productCanSell', 'productNotSell', 'productStory', 'slideGroup', 'productBrand', 'otherProducts', 'promotions'));
    }

    public function actionConfirmEmail() {
        $forget = trim($_POST['forget']);
        $user = \common\models\costfit\User::find()->where('email= "' . $forget . '"')->one();
        if (count($user) > 0) {
            $url = "http://" . Yii::$app->request->getServerName() . Yii::$app->homeUrl . "site/confirm?token=" . $user['token'];
            $toMail = $user['email'];
            $emailSend = \common\helpers\Email::mailRegisterConfirm($toMail, $url);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function actionSubscribe() {
        $email = trim($_POST['email']);

        $subscribe = Subscribe::find()->where(['email' => $email])->one();

        if (isset($subscribe)) {
            return 'You are already subscribed!';
        }

        $subscribe = new \common\models\costfit\Subscribe();
        $subscribe->email = $email;
        $subscribe->save(FALSE);
        echo 'Thanks for signing up for Cozxy emails!';
    }

}
