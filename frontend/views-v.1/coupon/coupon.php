<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php if (!isset($this->params['cart']['couponCode'])): ?>
    <h3>Have a coupon?</h3>
    <div class="coupon">
        <div class="form-group">
            <label class="sr-only" for="coupon-code">Enter coupon code</label>
            <input type="text" class="form-control" id="coupon-code" name="coupon-code" placeholder="Enter coupon code">
        </div>
        <input type="button" class="btn btn-primary btn-sm btn-block" name="apply-coupon" value="Apply coupon" onclick="proceed('apply_coupon')">
    </div>
<?php endif; ?>