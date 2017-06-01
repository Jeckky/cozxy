<?php

namespace frontend\controllers;

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

/**
 * Site controller
 */
class SiteController extends Controller {

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
        $slideGroup = new ArrayDataProvider(['allModels' => FakeFactory::productSlideGroup('', '')]);
        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(6, FALSE)]);
        $productNotSell = new ArrayDataProvider(['allModels' => FakeFactory::productForNotSale(6)]);
        $productStory = new ArrayDataProvider(['allModels' => FakeFactory::productStory(3)]);
        $productBrand = new ArrayDataProvider(['allModels' => FakeFactory::productSlideBanner('', '')]);
        return $this->render('index', compact('productCanSell', 'productNotSell', 'productStory', 'slideGroup', 'productBrand'));
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

        if ($model->load(Yii::$app->request->post())) {
            //echo '<pre>';
            //print_r($model);
            //exit();
        }


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
//            return $this->render('login', [
//                'model' => $model,
//            ]);
            return $this->render('@app/themes/cozxy/layouts/_login', compact('model'));
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
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
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
        $model = new SignupForm(['scenario' => 'register']);

        if (isset($_POST["SignupForm"])) {

            if ($model->load(Yii::$app->request->post())) {
                $model->attributes = $_POST["SignupForm"];
                $model->birthDate = $_POST["SignupForm"]['yyyy'] . '-' . $_POST["SignupForm"]['dd'] . '-' . $_POST["SignupForm"]['dd'];
                //echo $model->birthDate;
                //exit();
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        //return $this->goHome();
                        return $this->redirect([Yii::$app->homeUrl . 'site/thank']);
                    }
                }
            }
        } else {

        }

        return $this->render('@app/themes/cozxy/layouts/_register', [
                    'model' => $model,
        ]);
    }

    public function actionConfirm() {

        $user = \common\models\costfit\User::find()->where("token = '" . $_GET["token"] . "'")->one();
        if (isset($user)) {
            $user->status = 1;
            $user->save(FALSE);
            return $this->redirect([Yii::$app->homeUrl . 'site/thank?verification=complete']);
        } else {

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
                        ]
        );
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

        return $this->render('thank');
    }

}
