<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo $baseUrl; ?>">Home</a></li>
    <li><a href="<?php echo $baseUrl; ?>/register/login">Login</a>/ <a href="<?php echo $baseUrl; ?>/register/login">register</a></li>
</ol><!--Breadcrumbs Close-->

<!--Login / Register-->
<section class="log-reg container">
    <h2>Login/ register</h2>
    <h4>Use social accounts</h4>
    <div class="social-login">
<!--        <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>
        <a class="google" href="#"><i class="fa fa-google-plus-square"></i></a>
        <a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a>-->
        <?= common\yii2\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]) ?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-ms-12 ">
            <?php if (isset($model)): ?>
                <?= Html::errorSummary($model); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <!--Login-->
        <div class="col-lg-5 col-md-5 col-sm-5">
            <form method="post" class="login-form" action="<?php echo $baseUrl; ?>/register/login">
                <div class="form-group group">
                    <label for="log-email2">Email</label>
                    <input type="email" class="form-control" name="LoginForm[email]" id="log-email2" placeholder="Enter your email" required>
                    <!--<a class="help-link" href="#">Forgot email?</a>-->
                </div>
                <div class="form-group group">
                    <label for="log-password2">Password</label>
                    <input type="text" class="form-control" name="LoginForm[password]" id="log-password2" placeholder="Enter your password" required>
                    <a class="help-link" href="<?php echo Yii::$app->homeUrl; ?>register/forgot">Forgot password?</a>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <input class="btn btn-black" type="submit" value="Login">
            </form>
        </div>
        <!--Registration-->
        <div class="col-lg-7 col-md-7 col-sm-7">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'registr-form']]); ?>
            <?//= $form->errorSummary($model); ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
            <div class="checkbox">
                <label><input type="checkbox" name="User[acceptTerm]"> I have read and agree with the terms</label>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Register', ['class' => 'btn btn-black', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
<!--            <form method="post" class="registr-form" action="<?php echo $baseUrl; ?>/register/register">
                <div class="form-group group">
                    <label for="rf-email">Email</label>
                    <input type="email" class="form-control" name="User[email]" id="rf-email" placeholder="Enter email" required>
                </div>
                <div class="form-group group">
                    <label for="rf-password">Password</label>
                    <input type="password" class="form-control" name="User[password]" id="rf-password" placeholder="Enter password" required>
                </div>
                <div class="form-group group">
                    <label for="rf-password-repeat">Repeat password</label>
                    <input type="password" class="form-control" name="User[confirmPassword]" id="rf-password-repeat" placeholder="Repeat password" required>
                </div>

                <input class="btn btn-black" type="submit" value="Register">
            </form>-->
        </div>
    </div>
</section><!--Login / Register Close-->

<!--Brands Carousel Widget-->

<?php echo $this->render('@app/themes/costfit/layouts/_brand_carousel'); ?>
