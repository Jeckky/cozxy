<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$firstname = Yii::$app->user->identity->firstname;
$lastname = Yii::$app->user->identity->lastname;

if (empty($firstname)) {
    //echo 'firstname';
}

if (empty($lastname)) {
    //echo 'lastname';
}
?>
<!--Login Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
                </button>
                <h2><a href="<?php echo $baseUrl; ?>/register/login">Login</a> <span class="regis">or <a href="<?php echo $baseUrl; ?>/register/login">Register</a></span></h2>
                <p class="large">Use social accounts</p>
                <div class="social-login">
<!--                    <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>
                    <a class="google" href="#"><i class="fa fa-google-plus-square"></i></a>
                    <a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a>-->
                    <?= common\yii2\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]) ?>
                </div>
            </div>
            <div class="modal-body">
                <?php $loginForm = new common\models\LoginForm(); ?>
                <?php $form = yii\bootstrap\ActiveForm::begin(['id' => 'login-form', 'action' => $baseUrl . '/register/login', 'options' => ['class' => 'login-form']]); ?>
                <?//= $form->errorSummary($model); ?>
                <?= $form->field($loginForm, 'email')->textInput(['class' => 'loginEmail form-control']) ?>
                <?= $form->field($loginForm, 'password')->passwordInput() ?>
                <div class="checkbox">
                    <?= $form->field($loginForm, 'rememberMe')->checkbox(); ?>
                </div>
                <div class="form-group">
                    <?= yii\helpers\Html::submitButton('Login', ['class' => 'btn btn-black', 'name' => 'login-button']) ?>
                    <button id="login_register_btn" type="button" class="no btn btn-danger hide">Not You ?</button>
                </div>
                <?php yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Login confirmCart-->

<div class="modal fade" id="confirmCartModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-responsive img-circle-thumbnail" id="img_logo" src="<?php echo $baseUrl; ?>/images/modal/cost.fit.png" style="zoom:.8;">
            </div>

            <!-- Begin # DIV Form -->
            <!-- Begin # Login Form -->
            <div class="modal-body">
                <div id="div-login-msg">
                    <i class="icon-shopping-cart-content" style="zoom: 1"></i>
                    <span id="text-login-msg">&nbsp; มีสินค้าในตะกร้าอยู่</span>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #03a9f4;">
                <div id="div-login-msg ">
                    <?php
                    $token = $this->context->getToken();
                    $order = \common\models\costfit\Order::find()->where("token ='" . $token . "' AND status=" . \common\models\costfit\Order::ORDER_STATUS_DRAFT)->one();
                    ?>
                    <h4 class="text-center">คุณใช่ <span class="email"><?= isset($order->user) ? $order->user->email : "-" ?></span> หรือไม่ </h4>
                </div>
                <div class="text-center">
                    <button id="login_lost_btn" type="button" class="yes btn btn-primary">Yes</button>
                    <button id="login_register_btn" type="button" class="no btn btn-danger">No</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->


<!--Confirm reFormMember-->

<div class="modal hide fade" id="reFormMember" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <img class="img-responsive img-circle-thumbnail" id="img_logo" src="<?php echo $baseUrl; ?>/images/modal/cost.fit.png" style="zoom:.8;">
            </div>
            <!-- Begin # DIV Form -->
            <!-- Begin # Login Form -->
            <div class="modal-body">
                <div id="div-login-msg">
                    test
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #03a9f4;">
                <div id="div-login-msg ">
                    test
                </div>
                <div class="text-center">
                    <button id="login_lost_btn" type="button" class="yes btn btn-primary">Yes</button>
                    <button id="login_register_btn" type="button" class="no btn btn-danger">No</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
