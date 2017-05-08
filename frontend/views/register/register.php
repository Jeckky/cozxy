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
    <!--<h4>Use social accounts</h4>-->
    <code><?= isset($ms) ? $ms : ''; ?></code>
    <div class="social-login">

        <?php
        if (isset($_GET['verification'])) {
            echo '<h2><span style="color: #115d08;">Verification complete. Please log in </span></h2>';
        }
        ?>
        <!--
            <a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a>
            <a class="google" href="#"><i class="fa fa-google-plus-square"></i></a>
            <a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a>
        -->
        <?//= common\yii2\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth']]) ?>
    </div>
    <div class="row">
        <!--Login-->
        <div class="col-lg-5 col-md-5 col-sm-5">
            <!--<form method="post" class="login-form" action="<?//php echo $baseUrl; ?>/register/login">
                <div class="form-group group">
                    <label for="log-email2">Email</label>
                    <input type="email" class="form-control" name="LoginForm[email]" id="log-email2" placeholder="Enter your email" required>
                    <a class="help-link" href="#">Forgot email?</a>
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
            </form>-->
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => $baseUrl . '/register/login', 'options' => ['class' => 'login-form']]); ?>
            <?//= $form->errorSummary($model); ?>
            <?= $form->field($loginForm, 'email') ?>
            <?= $form->field($loginForm, 'password')->passwordInput() ?>
            <div class="checkbox">
                <?= $form->field($loginForm, 'rememberMe')->checkbox(); ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-black', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <?php
        //throw new yii\base\Exception($term->title);
        ?>
        <!--Registration-->
        <div class="col-lg-7 col-md-7 col-sm-7">

            <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => $baseUrl . '/register/register', 'options' => ['class' => 'registr-form']]); ?>
            <?//= $form->errorSummary($model); ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
            <div class="checkbox">
                <label><input type="checkbox" name="User[acceptTerm]"> I have read and agree with the <a href="#" data-toggle="modal" data-target="#terms"> terms</a></label>
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
<div class="modal fade" id="terms"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $term->contents[0]->title; ?></h4>
            </div>
            <div class="modal-body">
                <p>
                    <?php echo $term->contents[0]->description; ?>
                </p>


            </div>
        </div>

    </div>

</div>