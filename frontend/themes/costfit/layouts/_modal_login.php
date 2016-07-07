<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Login Modal-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
                </button>
                <h2><a href="<?php echo $baseUrl; ?>/register/login">Login</a> or <a href="<?php echo $baseUrl; ?>/register/login">Register</a></h2>
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
                <?= $form->field($loginForm, 'email') ?>
                <?= $form->field($loginForm, 'password')->passwordInput() ?>
                <div class="checkbox">
                    <?= $form->field($loginForm, 'rememberMe')->checkbox(); ?>
                </div>
                <div class="form-group">
                    <?= yii\helpers\Html::submitButton('Login', ['class' => 'btn btn-black', 'name' => 'login-button']) ?>
                </div>
                <?php yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->