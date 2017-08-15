<?php

use \yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use dosamigos\fileupload\FileUpload;
?>
<div class="row">
    <div class="col-md-2">Profile picture</div>
    <div class="col-md-10">
        Personal Details<?= \yii\bootstrap\Html::a('Edit', \yii\helpers\Url::to(['my-account/edit-personal-detail']), ['class' => 'pull-right btn-g999 p-edit']) ?>
    </div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>
<div class="row fc-g999">
    <div class="col-md-2 text-center">
        <?php
        $avatar = (isset($user->avatar)) ? $user->avatar : 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png';
        ?>
        <?= Html::img(Yii::$app->homeUrl . "images/user/avatar/" . $avatar, ['width' => 120, 'class' => 'img-circle', 'id' => 'avatar']) ?><br />
        <?=
        FileUpload::widget([
            'model' => $user,
            'attribute' => 'avatar',
            'url' => Url::home() . 'my-account/upload-avatar', // your url, this is just for demo purposes,
            'options' => ['accept' => 'image/*'],
            'clientOptions' => [
                'maxFileSize' => 2000000,
            ],
            // Also, you can specify jQuery-File-Upload events
            // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
            'clientEvents' => [
                'fileuploadstart' => 'function(e, data) {
                               $("#avatar").attr("style", "opacity:0.5;");
                            }',
                'fileuploaddone' => 'function(e, data) {
                                var res = JSON.parse(data.result);
                                $("#avatar").attr("src", res.avatar).removeAttr("style" );
                            }',
                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
            ],
        ]);
        ?>

        <!--        --><?//=Html::button('change', ['class'=>'btn btn-primary btn-xs', 'id'=>'profilePictureBtn'])?>

        <!--        --><?php //ActiveForm::begin();         ?>
        <!--        --><?//=Html::fileInput('profile', '', ['class'=>'hide', 'id'=>'profilePicture'])?>
        <!--        --><?php //ActiveForm::end();        ?>

    </div>
    <div class="col-md-10">
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $personalDetails,
            'options' => [
                'tag' => false,
            ],
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('@app/themes/cozxy/layouts/my-account/_account_detail_personal_details', ['model' => $model, 'index' => $index]);
            },
            //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
            //'layout'=>"{summary}{pager}{items}"
            'layout' => "{items}",
            'itemOptions' => [
                'tag' => false,
            ],
        ]);
        ?>
    </div>
</div>
<div class="size32 hr-margin">&nbsp;</div>

<div class="row">
    <div class="col-md-12">
        CozxyCoin(CXC)
        <!--<a href="javascript:edit_profile(1);" class="pull-right btn-g999 p-edit btn-yellow"><i class="fa fa-circle-thin"></i> Top Up</a>-->
        <?= \yii\bootstrap\Html::a('<i class="fa fa-circle-thin"></i> Top Up', \yii\helpers\Url::to(['/top-up']), ['class' => 'pull-right btn-g999 p-edit btn-yellow', 'style' => 'margin-right: 8px;']) ?>
        <!--<a href="javascript:edit_profile(1);" class="pull-right btn-g999 p-edit" style="margin-right: 8px;"><i class="fa fa-history"></i> History</a>-->
        <?= \yii\bootstrap\Html::a('<i class="fa fa-history"></i> Payment History', \yii\helpers\Url::to(['/top-up/history']), ['class' => 'pull-right btn-g999 p-edit', 'style' => 'margin-right: 8px;']) ?>
    </div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>
<div class="row fc-g999">
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $cozxyCoin,
        'options' => [
            'tag' => false,
        ],
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('@app/themes/cozxy/layouts/my-account/_account_detail_cozxy_coin', ['model' => $model, 'index' => $index]);
        },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
        //'layout'=>"{summary}{pager}{items}"
        'layout' => "{items}",
        'itemOptions' => [
            'tag' => false,
        ],
    ]);
    ?>
</div>

<?php
/*
  <div class="row">
  <div class="col-lg-3 col-md-4 col-sm-6">Shipping
  Address<a href="javascript:edit_profile(2);" class="pull-right btn-g999 p-edit">Edit</a></div>
  <div class="col-xs-12 size6">&nbsp;</div>
  </div>
  <div class="row fc-g999">
  <div class="col-sm-12 col-md-2">Name:</div>
  <div class="col-sm-12 col-md-10">Inthanon Panyasopa</div>
  <div class="col-sm-12 col-md-2">Address:</div>
  <div class="col-sm-12 col-md-10">123 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
  eiusmod tempor incididunt ut labore et dolore magna aliqua 50000
  </div>
  <div class="size12">&nbsp;</div>
  <div class="size32 hr-margin">&nbsp;</div>
  </div>
 */
?>

<div class="row">
    <div class="col-md-12">
        Billing Address
        <?= \yii\bootstrap\Html::a('+ New Billing Address', \yii\helpers\Url::to(['my-account/new-billing']), ['class' => 'pull-right btn-g999 p-edit btn-yellow']) ?>
    </div>
    <div class="col-xs-12 size6">&nbsp;</div>
</div>

<div class="row fc-g999">
    <div class="col-xs-12">
        <div class="row">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $billingAddress,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('@app/themes/cozxy/layouts/my-account/_account_detail_billing_address', ['model' => $model, 'index' => $index]);
                },
//                        'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}",
                'itemOptions' => [
                    'tag' => false,
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="size12">&nbsp;</div>
    <div class="size32 hr-margin">&nbsp;</div>
</div>

<?php
$this->registerJs('
$("#profilePictureBtn").click(function(e){
    e.preventDefault();
    $("#profilePicture").trigger("click");
});
');

$this->registerCss("
.fileinput-button {
    margin-top:5px;
    padding:5px;
    font-size:12px;
}

.fileinput-button span, .fileinput-button i{
    display:none;

}

.fileinput-button:after {
    content:'Update Profile Picture';
}
");
?>