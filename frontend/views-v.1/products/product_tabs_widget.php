<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    #description , p{
        font-family: "Open Sans", Helvetica, Arial, sans-serif;
        font-size: 1em;
        line-height: 1.42857143;
        color: #292c2e;
        /*white-space: pre-wrap;*/
    }
    #specification , p{
        font-family: "Open Sans", Helvetica, Arial, sans-serif;
        font-size: 1em;
        line-height: 1.42857143;
        color: #292c2e;
        /*white-space: pre-wrap;*/
    }

</style>
<!--Tab1 (Specs)-->
<div class="tab-pane fade" id="specs">
    <div class="container">
        <div class="row">
            <section class="tech-specs">
                <div class="container">
                    <div class="row">
                        <!--Column 1-->
                        <div class="col-lg-12 col-md-12 col-sm-12 text-left" id="specification">
                            <!--<p class="p-style2 ">-->
                            <?= $model->specification; ?><?//= strip_tags($model->specification); ?>
                            <!--</p>-->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!--Tab2 (Description)-->
<div class="tab-pane fade  in active" id="descr">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" id="description">
                <!--<p class="p-style2" style="color: #000;">-->
                <?= $model->description; ?><?//= strip_tags($model->description); ?>
                <!--</p>-->
            </div>
        </div>
    </div>
</div>

<!--Tab3 (Reviews)
<div class="tab-pane fade" id="term">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" id="Term-Condition">
<?php
//if (isset($term) && !empty($term)) {
//echo $term->description;
//}
?>
            </div>
        </div>
    </div>
</div>-->