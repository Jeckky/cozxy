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
        $this->title = 'My Cost.fit';
        $bannerGroup = ContentGroup::find()->where("lower(title) = 'banner'")->one();
        $topOne = ContentGroup::find()->where("lower(title)='topOne'")->one();
        $topOneContent = Content::find()->where("contentGroupId='" . $topOne->contentGroupId . "' order by contentId DESC limit 0,1")->one();
        $bottomIndexGroup = ContentGroup::find()->where("lower(title)='bottomIndex'")->one();
        $bottomContent = Content::find()->where("contentGroupId='" . $bottomIndexGroup->contentGroupId . "'")->all();
        $lastIndexGroup = ContentGroup::find()->where("lower(title)='lastIndex'")->one();
        $lastIndexContent = Content::find()->where("contentGroupId='" . $lastIndexGroup->contentGroupId . "' order by contentId DESC limit 0,1")->one();
        $product = \common\models\costfit\search\Product::find()->where("categoryId='3'")->all();
        $saveCat = Category::findAllSaveCategory();
        $popularCat = Category::findAllPopularCategory();
        return $this->render('index', compact('saveCat', 'popularCat', 'bannerGroup', 'topOneContent', 'bottomContent', 'lastIndexContent', 'product'));
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
//        throw new \yii\base\Exception(print_r($attributes, true));
        if (isset($attributes['email'])) {
            //facebook
            $email = $attributes['email'];
            $name = explode(' ', $attributes['name']);
            $fName = current($name);
            $lName = end($name);
        } else {
            //google
            $fName = $attributes['name']['givenName'];
            $lName = $attributes['name']['familyName'];
            $email = $attributes['emails'][0]['value'];
        }

        $user = User::find()->where(['email' => $email])->one();
        if (!empty($user)) {
            Yii::$app->user->login($user);
        } else {
//            $session = Yii::$app->session;
//            $session['attributes'] = $attributes;
//            $this->successUrl = Url::to(['signup']);

            $model = new SignupForm();
            $model->username = $model->email = $email;
            $model->password = substr(md5(time()), 0, 8);
            $model->fName = $fName;
            $model->lName = $lName;
            if ($user = $model->signup(2)) {
                //login
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
    }

}
