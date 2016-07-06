<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="col-md-12"> 
    <div class="form-group">
        <label class="sr-only" for="order-notes">Order notes</label>
        <textarea class="form-control" name="order-notes" id="order-notes" rows="4" placeholder="Order notes"></textarea>
    </div>
</div>