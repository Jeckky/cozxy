<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//throw new \yii\base\Exception('aa');
?>
<!--Confirm reFormMember-->

<div class="modal fade" id="modal-not-enough"  tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"  style="color: #000;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <span class="text-left">
                    รายการสินค้าไม่พอจำหน่าย
                </span>
            </div>
            <br>
            <div class="modal-body" >
                <span class="text-center">
                    <center>
                        <!--<i class="icon-shopping-cart-content" style="zoom:8;"></i>-->
                    </center>
                </span><br><center><code>สินค้าในตะกร้า 0 รายการ</code></center>
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
