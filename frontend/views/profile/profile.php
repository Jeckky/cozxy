<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yi\web\view;
use yii\widgets\ListView;
// add this in your view
use kartik\password\PasswordInput;

//use kartik\widgets\ActiveForm; // optional
//use kartik\;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$createDateTime = $this->context->dateThai(Yii::$app->user->identity->createDateTime, 4);
?>

<div class="row cs-page">
    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <h4 class="profile-title-head">
                <span class="profile-title-head">FREE MEMBERSHIP</span>
            </h4>
            <p>Member since
                <span class="member-since"><?php echo $createDateTime; ?></span><!--Apr 9,2016 -->
            </p>
            <!--<hr>
            <p class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;">You've Saved</p>
            <p class="col-lg-6 col-md-6 col-sm-6 text-right">THB 0.00</p>
            <br>-->
        </div>

        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
            <div class="col-lg-6 col-md-6 col-sm-6 text-left" style="padding-left: 0px;"><h4>Contact Information</h4></div>
            <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                <span class="profile-title"><a href="<?php echo Yii::$app->homeUrl ?>profile/edit-info" class="btn btn-black">Edit</a></span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <p>Name : <?php echo (isset($model->firstname) && isset($model->lastname)) ? $model->firstname . '&nbsp;' . $model->lastname : "<span style='color:red'>Please update you name</span>" ?></p>
                <p>Email : <?php echo $model->email; ?></p>
                <p>Gender : <?php echo isset($model->gender) ? $model->getGenderTextEn($model->gender) : "<span style='color:red'>Please update you gender</span>"; ?></p>
                <p>Date of Birth : <?php echo isset($model->birthDate) ? $this->context->dateThai($model->birthDate, 4) : "<span style='color:red'>Please update your date-of-birth</span>"; ?></p>
                <p>Tel. : <?php echo isset($model->tel) ? $model->tel : "<span style='color:red'>Please update you Tel</span>"; ?></p>
            </div>

            <hr>
            <h4>
                Change password
            </h4>
            <div class="col-md-12 text-center">
                <?php
                if (isset($_GET['verification'])) {
                    echo '<h4><span style="color: #115d08;">Change password successfully.</span></h4>';
                }
                ?>
            </div>
            <?php
            $form = ActiveForm::begin([
                'id' => 'password-form',
                'options' => ['class' => 'password-form ']
            ]);
            ?>
            <?=
            $form->field($model, 'currentPassword', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_current" type="button">
                            <span class="reveal-title-current">Show</span>
                        </button></span></div>',
            ])->passwordInput()->textInput(['type' => 'password', 'class' => 'form-control pwd1', 'onchange' => '
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
            <?//=
            $form->field($model, 'newPassword', [
            'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_new" type="button">
            <span class="reveal-title-new">Show</span>
            </button></span></div>',
            ])->passwordInput()->textInput(['class' => 'form-control pwd2', 'disabled' => true, 'type' => 'password']);
            ?>
            <?=
            $form->field($model, 'newPassword', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_new" type="button">
                            <span class="reveal-title-new">Show</span>
                        </button></span></div>',
            ])->widget(PasswordInput::classname(), [
                'pluginOptions' => [
                    'showMeter' => true,
                    'toggleMask' => false
                ]
            ])->textInput(['class' => 'form-control pwd2', 'disabled' => true, 'type' => 'password']);
            ?>
            <?=
            $form->field($model, 'rePassword', [
                'inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon"><button class="reveal_re" type="button">
                            <span class="reveal-title-re">Show</span>
                        </button></span></div>',
            ])->passwordInput()->textInput(['class' => 'form-control pwd3', 'disabled' => true, 'type' => 'password']);
            ?>


            <?= Html::submitButton('Update Password', ['class' => 'btn btn-primary', 'name' => 'contact-info', 'style' => 'background-color: #3cc; color: #fff;']) ?>
            <?php ActiveForm::end(); ?>

        </div>
    </div><!-- Zone left -->

</div>

