<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="col-md-12">
    <div class="form-group">
        <label for="co-company-name">Company name 1</label>
        <input type="text" class="form-control" id="co-company-name" name="co-company-name" placeholder="Company name">
    </div>
    <div class="form-group">
        <label for="co-company-name">Company name 2</label>
        <input type="text" class="form-control" id="co-company-name" name="co-company-name" placeholder="Company name">
    </div>
</div>