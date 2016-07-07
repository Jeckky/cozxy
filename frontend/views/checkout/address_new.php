<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<?php
for ($index = 0; $index <= 2; $index++) {
    ?>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="tile text-center" style="padding: 5px; font-size: 14px; border: 1px #003147 solid; word-wrap: break-word;">
            นายกมล พวงเกษม<br>
            เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19<br>
            จอมพล จตุจักร กรุงเทพ<br>
            10900<br><br>
            <div class="footer-cost-fit">
                <a class="panel-toggle" href="#address1">

                    <div class="radio light">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-sm btn-info checkout_select">
                                <input type="radio" name="checkout_select_address" id="checkout_select_address" <?php
                                if ($index == 0) {
                                    echo "checked";
                                }
                                ?> value="<?php echo $index; ?>"> แก้ไขที่อยู่ <span class="pp-label"></span>
                            </label>
                        </div>
                        <label></label>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php
    $index = $index++;
}
?>