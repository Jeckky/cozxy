<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
    <li>
        <a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>">
            <?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?>
        </a>
    </li>
</ol><!--Breadcrumbs Close-->

<!--Content-->
<div class="coming-soon">

    <section class="container">
        <div class="row space-top">
            <div class="col-lg-3 col-md-3 col-sm-3">&nbsp;</div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h3 class="cs-heading"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></h3>
                <form class="space-bottom" role="form" method="post">

                    <div class="form-group">
                        <label for="cs-password">Password</label>
                        <input type="password" class="form-control" id="cs-password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">&nbsp;</div>
        </div>
    </section>

</div><!--Content Close-->
