<?php
//echo $value->title;
$userLogin = Yii::$app->user->identity->userId;
if ($model->userId == $userLogin) {
    $css = 'border: 1px rgba(255,212,36,.9) solid; background-color: #f8f8f8;';
} else {
    $css = '';
}
?>
<div class="text-center col-sm-2" id="reviews-rate-show-<?php echo $model->productPostId; ?>" style="margin-bottom: 2px; margin-left: 2px;border: 1px #e6e6e6 solid; max-height: 460px; min-height: 160px; padding: 5px;<?php echo $css ?>">
    <div class="text-left" style="margin-bottom:2px; border-bottom: 1px #e6e6e6 dashed;">
        <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-rating?productPostId=<?php echo $model->productPostId; ?>&productSupplierId=<?php echo $model->productSuppId; ?>&productId=<?php echo $model->productSupp->product->productId; ?>"
           style="font-size: 13px;"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo $model->title; ?></a>
    </div>
    <div class="text-left test" style="margin-bottom:2px; font-size: 12px; height: 120px; color: #292c2e;">
        &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $model->shortDescription; ?>
    </div>
    <div class="text-center" style="margin-bottom:2px; border-bottom: 1px #e6e6e6 dashed;">
        <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-rating?productPostId=<?php echo $model->productPostId; ?>&productSupplierId=<?php echo $model->productSuppId; ?>&productId=<?php echo $model->productSupp->product->productId; ?>"
           style="font-size: 13px;" class="btn btn-primary btn-xs">see more</a>
    </div>
    <div style="text-align: right;">
        <span class="pull-left"><i class="fa fa-eye "></i> <?= number_format(\common\models\costfit\ProductPost::getCountViews($model->productPostId)); ?> Views</span>
        <!--<a role="button"  onclick="views_click('<?php // echo $model->productPostId           ?>', '<?php // echo $model->productSuppId;           ?>', '<?php // echo $model->productSupp->product->productId;           ?>')"  class="panel-toggle" id="see-reviews" style="font-size: 14px; border-bottom: 0px dashed #292c2e;"><i class="fa fa-angle-right" aria-hidden="true"></i></a>-->
    </div>
</div>



