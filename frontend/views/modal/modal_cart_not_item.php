<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Confirm reFormMember-->

<div class="modal fade" id="reFormMember"  tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom-color:#fff;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <span class="text-left">
                    สินค้าในตะกร้า 0 รายการ
                </span>
            </div>
            <br>
            <div class="modal-body" >
                <span class="text-center">
                    <center>
                        <img class="img-responsive img-circle-thumbnail" id="img_logo" src="<?php echo $baseUrl; ?>/images/modal/cost.fit.png" style="zoom:.8;">
                    </center>
                </span><br>
                <p class="large text-center">
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #03a9f4;">
                <div class="text-center">
                    <a href="<?php echo Yii::$app->homeUrl; ?>profile" class="yes btn btn-primary">Update Info</a>
                    <a href="#" class="no btn btn-danger" data-dismiss="modal" id="no-thank">No Thank</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
