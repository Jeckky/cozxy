<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
//use \yii\jui\DatePicker;
use kartik\date\DatePicker;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .table{
        font-size: 13px;
        white-space:pre-line;
        color:#292c2e;

    }
    .table>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 1px solid #ddd;
    }
    th {
        font-weight: 600;
    }
    .bg-purchase-order{
        background-color: #f5f5f5;
    }

</style>
<h3><i class="fa fa-file-text" aria-hidden="true"></i> <?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></h3>

<!--Support-->
<section class="support">
    <div class="row">
        <!--Left Column-->
        <div class="col-lg-12 col-md-12">
            <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">

                XXXX    

            </div>
        </div>
    </div>
</section>

<section class="support">
    <div class="row">
        <!--Left Column-->
        <div class="col-lg-12 col-md-12">


        </div>
    </div>
</section><!--Support Close-->

