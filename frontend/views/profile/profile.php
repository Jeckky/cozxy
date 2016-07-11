<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="row cs-page">
    <h2 class="title">Hello , Sukanyaa Nithi</h2>
    <div class="row space-top">

        <div class="clo-lg-8 col-md-8 col-sm-8">
            <table>
                <tbody>
                    <tr>
                        <th>Hello ,Sukanyaa Nithi</th>
                    </tr>
                    <!--Item-->
                    <tr class="item first">
                        <td>xx</td>
                    </tr>
                </tbody>
            </table>
        </div><!-- Zone left -->

        <div class="clo-lg-4 col-md-4 col-sm-4">
            <table>
                <tbody>
                    <tr>
                        <th>Default Shipping Address</th>
                    </tr>
                    <!--Item-->
                    <tr class="item first">
                        <td>xx</td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <table>
                <tbody>
                    <tr>
                        <th>Default Shipping Address</th>
                    </tr>
                    <!--Item-->
                    <tr class="item first">
                        <td>xx</td>
                    </tr>
                </tbody>
            </table>

        </div><!-- Zone Right -->
    </div>
</div>

