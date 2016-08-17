<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Confirm reFormMember-->

<div class="modal fade" id="modal-cart-not-shipping"  tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="color: #000;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <span class="text-left">
                    Select Shipping Address
                </span>
            </div>
            <br>
            <div class="modal-body" >
                <span class="text-center">
                    <center>
                       <!-- <img src="<?php echo $baseUrl; ?>/images/icon/Fast-Deliver-1.png" alt="cost.fit" style="zoom:5;">-->
                    </center>
                </span><br><center><code> Select Shipping Address Please</code></center>
                <p class="large text-center">
                </p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #03a9f4;">
                <div class="text-center">
                    <a href="<?php echo Yii::$app->homeUrl; ?>" class="yes btn btn-primary">Select Items</a>
                    <a href="#" class="no btn btn-danger" data-dismiss="modal" id="no-thank">No Thank</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
