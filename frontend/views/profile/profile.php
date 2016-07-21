<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;

//use kartik\;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, '');
?>

<div class="row cs-page">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <h4 class="profile-title-head">
                <span class="profile-title-head">FREE MEMBERSHIP</span>
            </h4>
            <p>Member since
                <span style="color: #03a9f4;"><?php echo $createDateTime; ?></span><!--Apr 9,2016 -->
            </p>
            <hr>
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">You've Saved</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">THB 0.00</p>
            <br>
        </div>

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">Contact Information</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">
                <span class="profile-title"><a href="<?php echo Yii::$app->homeUrl ?>profile/edit-info">Edit</a></span>
            </p>
            <p>Name : <?php echo Yii::$app->user->identity->firstname . '&nbsp;' . Yii::$app->user->identity->lastname ?></p>
            <p>Email : <?php echo Yii::$app->user->identity->email; ?></p>
            <hr>
            <h5>
                <span class="profile-title-head">Password</span>
            </h5>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'password-form',
                        'options' => ['class' => 'password-form']
            ]);
            ?>
            <?=
            $form->field($model, 'currentPassword', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_current" type="button">
                            <span class="reveal-title-current">Show</span>
                        </button></span></div>',
            ])->passwordInput()->textInput(['class' => 'form-control pwd1', 'onchange' => '
                $.post( "' . $baseUrl . '/profile/reset", {token: $(this).val()}, function( data ) {
                  //$( "#suborders-product_price" ).val( data );
                    if(data == 1){
                        $("#user-newpassword").prop("disabled", false);
                        $("#user-repassword").prop("disabled", false);
                        $("#suborders-product_price").html("").css("color", "#a94442");
                    }else{
                        $("#user-newpassword").prop("disabled", true);
                        $("#user-repassword").prop("disabled", true);
                        $("#suborders-product_price").html("Please try again in a few minutes.").css("color", "#a94442");
                    }
                });
            ']);
            ?>
            <p id="suborders-product_price">
            </p>
            <?=
            $form->field($model, 'newPassword', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_new" type="button">
                            <span class="reveal-title-new">Show</span>
                        </button></span></div>',
            ])->passwordInput()->textInput(['class' => 'form-control pwd2', 'disabled' => true]);
            ?>
            <?=
            $form->field($model, 'rePassword', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_re" type="button">
                            <span class="reveal-title-re">Show</span>
                        </button></span></div>',
            ])->passwordInput()->textInput(['class' => 'form-control pwd3', 'disabled' => true]);
            ?>
            <?= Html::submitButton('Update Password', ['class' => 'btn btn-primary', 'name' => 'contact-info', 'style' => 'background-color: #3cc; color: #fff;']) ?>
            <?php ActiveForm::end(); ?>

        </div>
    </div><!-- Zone left -->

</div>

