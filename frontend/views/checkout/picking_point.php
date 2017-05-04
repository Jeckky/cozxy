<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use common\helpers\GetBrowser;

$yourbrowser = GetBrowser::Browser();
/* $form = ActiveForm::begin([
  'id' => 'checkout-form-picking',
  //'validateOnSubmit' => true,
  'options' => ['class' => "space-bottom"],
  ]);
 */
$form = ActiveForm::begin(['action' => '#', 'id' => 'checkout-form-picking', 'method' => '', 'options' => ['class' => "space-bottom"]]);
$countryId = rand(0, 9999);
$stateId = rand(0, 9999);
$cityId = rand(0, 9999);
$districtId = rand(0, 9999);
$pickingId = rand(0, 9999);
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
preg_match("/dbname=([^;]*)/", Yii::$app->get("db")->dsn, $dbName);
?>
<style type="text/css">
    .main-title-picking-point{
        height: 80px;
    }
    .main-list-picking-point{
        height: 185px;
        overflow-y: auto;
    }
    .main-list-picking-point-detail{
        height: 102px;
        overflow-y: auto;
    }
    .selection{
        display: block;
        width: 100%;
        /*height: 46px;*/
        padding: 6px 12px;
        font-size: 1em;
        font-weight: 300;
        line-height: 1.42857143;
        color: #292c2e;
        background: transparent;
        border: 1px solid rgba(255,212,36,.9);
        border-radius: 0;
        box-shadow: none;

    }
    .select2-container--krajee .select2-selection{
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        background-color: #fff;
        /* border: 1px solid #ccc;*/
        border-radius: 4px;
        color: #555555;
        font-size: 14px;
        outline: 0;
        border: none;
        border-color: transparent;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        /*height: 28px;*/
        user-select: none;
        -webkit-user-select: none;
    }
    .select2-container--krajee .select2-selection {
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        background-color: #fff;
        border: 0px solid rgba(204, 204, 204, 0);
        border-radius: 0px;
        color: #555555;
        font-size: 14px;
        outline: 0;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__arrow {
        border: none;
        /* border-left: 1px solid #aaa; */
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        position: absolute;
        height: 32px;
        top: 6px;
        right: -2px;
        width: 20px;
    }
    .select2-container--krajee.select2-container--disabled .select2-selection, .select2-container--krajee.select2-container--disabled .select2-selection--multiple .select2-selection__choice {
        background-color: #f5f5f5;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__rendered {
        color: #000;
        padding: 0;
    }
    .select2-container--krajee .select2-selection--single .select2-selection__placeholder {
        color: #000;
    }
    .select2-container--krajee .select2-dropdown {
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        border-color: #66afe9;
        overflow-x: hidden;
        margin-top: -1px;
        padding: 15px;
    }
</style>


<?php
//echo 'ListpickpointBoothValueInLocation : ' . $BoothHistory['ListpickpointBoothValueInLocation'];
//echo $LockerHistory['LockersHistoryLockersNoti'] . '<br>';
//echo $LockerHistory['ListpickpointLockersValueInLocation'];
//('BoothHistory', 'LockerHistory'
$LocationHistoryLockers = $BoothHistory;
$LocationHistoryBooth = $LockerHistory;
$countType = count($GetOrderMastersGroup);

//echo '<pre>';
//($LocationHistoryLockers);
//($LocationHistoryBooth);
$BoothOrderItemId = $BoothHistory['BoothOrderItemId'];
$BoothOrderId = $BoothHistory['BoothOrderId'];
$BoothProductId = $BoothHistory['BoothProductId'];
$BoothReceiveType = $BoothHistory['BoothReceiveType'];
$BoothPickingId = $BoothHistory['BoothPickingId'];
$BoothHistoryBoothNoti = $BoothHistory['BoothHistoryBoothNoti'];
//echo $BoothHistoryBoothNoti;
if ($BoothHistoryBoothNoti == 'isTrue') {
    /* แสดง pickpoint ที่ลูกค้าเคยเลือกตอนสั่งซื้อในรอบที่แล้ว */
    $ListpickpointBoothValueInLocation = $BoothHistory['ListpickpointBoothValueInLocation'];
    $ListOrderItemGroupBoothAction = 'isTrue';
} else {
    $ListOrderItemGroupBoothValue = $CheckValuePickPoint['ListOrderItemGroupBoothValue'];
    $ListOrderItemGroupBoothAction = $CheckValuePickPoint['ListOrderItemGroupBoothAction'];
    $ListpickpointBoothValueInLocation = $CheckValuePickPoint['ListpickpointBoothValueInLocation'];
}
/*
 * Lockers ร้อน
 */
$LockersOrderItemId = $LockerHistory['LockersOrderItemId'];
$LockersOrderId = $LockerHistory['LockersOrderId'];
$LockersProductId = $LockerHistory['LockersProductId'];
$LockersReceiveType = $LockerHistory['LockersReceiveType'];
$LockersPickingId = $LockerHistory['LockersPickingId'];
$LockersHistoryLockersNoti = $LockerHistory['LockersHistoryLockersNoti'];
//$ListpickpointLockersValueInLocation = $LockerHistory['ListpickpointLockersValueInLocation'];
//echo '<pre>';
//print_r($CheckValuePickPoint['ListOrderItemGroupLockersValue']);
//exit();
//echo $LockersHistoryLockersNoti;
//exit();
if ($LockersHistoryLockersNoti == 'isTrue') {
    /* แสดง pickpoint ที่ลูกค้าเคยเลือกตอนสั่งซื้อในรอบที่แล้ว */
    $ListpickpointLockersValueInLocation = $LockerHistory['ListpickpointLockersValueInLocation'];
    $ListOrderItemGroupLockersAction = 'isTrue';
} else {
    $ListOrderItemGroupLockersValue = $CheckValuePickPoint['ListOrderItemGroupLockersValue'];
    $ListOrderItemGroupLockersAction = $CheckValuePickPoint['ListOrderItemGroupLockersAction'];
    $ListpickpointLockersValueInLocation = $CheckValuePickPoint['ListpickpointLockersValueInLocation'];
}
/*
 * Lockers เย็น
 */
$LockersCoolOrderItemId = $LockerHistory['LockersCoolOrderItemId'];
$LockersCoolOrderId = $LockerHistory['LockersCoolOrderId'];
$LockersCoolProductId = $LockerHistory['LockersCoolProductId'];
$LockersCoolReceiveType = $LockerHistory['LockersCoolReceiveType'];
$LockersCoolPickingId = $LockerHistory['LockersCoolPickingId'];
$LockersCoolHistoryLockersNoti = $LockerHistory['LockersCoolHistoryLockersNoti'];
//$ListpickpointLockersValueInLocation = $LockerHistory['ListpickpointLockersValueInLocation'];

if ($LockersCoolHistoryLockersNoti == 'isTrue') {
    /* แสดง pickpoint ที่ลูกค้าเคยเลือกตอนสั่งซื้อในรอบที่แล้ว */
    $ListpickpointLockersCoolValueInLocation = $LockerHistory['ListpickpointLockersCoolValueInLocation'];
    $ListOrderItemGroupLockersCoolAction = 'isTrue';
} else {
    $ListOrderItemGroupLockersCoolValue = $CheckValuePickPoint['ListOrderItemGroupLockersCoolValue'];
    $ListOrderItemGroupLockersCoolAction = $CheckValuePickPoint['ListOrderItemGroupLockersCoolAction'];
    $ListpickpointLockersCoolValueInLocation = $CheckValuePickPoint['ListpickpointLockersCoolValueInLocation'];
}
foreach ($GetOrderMastersGroup as $value) {
    /*
     * ปลายทางรับของที่ Lockers เย็น
     */

    if ($value->receiveType == '2') {//ประเภทปลายทางแบบล็อคเกอร์ร้อน
// Lockers
// = $CheckValuePickPoint['ListOrderItemGroupLockersValue'];
// = $CheckValuePickPoint['ListOrderItemGroupLockersAction'];
// = $CheckValuePickPoint['ListpickpointLockersValueInLocation'];
//echo 'ประเภทปลายทางแบบล็อคเกอร์ร้อน';
        ?>
        <div id="lockers-hot-status-2" class="col-lg-12 col-md-12 col-sm-12">
            <h5><i class="fa fa-align-justify" aria-hidden="true"></i> เลือกสถานที่รับของ : ปลายทางที่ล็อคเกอร์ร้อน</h5>
            <hr>
            <div id="lockers-province" class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
//                $dbName = Yii::$app->get("db")->dsn;
                // Child level 1
                // Additional input fields passed as params to the child dropdown's pluginOptions
                echo Html::hiddenInput('input-type-1', $ListpickpointLockersValueInLocation['provinceId'], ['id' => 'input-type-1']);
                echo Html::hiddenInput('input-type-2', $ListpickpointLockersValueInLocation['provinceId'], ['id' => 'input-type-2']);
                echo $form->field($pickingPointLockers, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                    'model' => $pickingId,
                    'attribute' => 'provinceId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()
                    ->join("RIGHT JOIN", "$dbName[1].picking_point", "picking_point.provinceId = states.stateId ")
                    ->where("states.countryId = 'THA' AND picking_point.type = 2")->asArray()->all(), 'stateId', 'localName'),
                    'pluginOptions' => [
                        'placeholder' => 'Select...',
                        'loadingText' => 'Loading province ...',
                        'params' => ['input-type-1', 'input-type-2']
                    ],
                    'options' => ['placeholder' => 'Select states ...']
                ])->label('Province');
                ?>
                <?php
                //echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
                ?>
            </div>
            <div id="lockers-amphur" class="form-group col-lg-6 col-md-6 col-sm-6 ">
                <?php
                // Child level 2
                echo Html::hiddenInput('input-type-11', $ListpickpointLockersValueInLocation['amphurId'], ['id' => 'input-type-11']);
                echo Html::hiddenInput('input-type-22', $ListpickpointLockersValueInLocation['amphurId'], ['id' => 'input-type-22']);
                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointLockers, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'amphurId',
                        'options' => ['placeholder' => 'Select ...'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                        'pluginOptions' => [
                            'class' => 'required ',
                            'initialize' => true,
                            'depends' => ['pickingpoint-provinceid'],
                            'url' => Url::to(['child-amphur-address-picking-point']),
                            'loadingText' => 'Loading amphur ...',
                            'params' => ['input-type-11', 'input-type-22']
                        ]
                    ])->label('Amphur');
                } else {
                    echo $form->field($pickingPointLockers, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'amphurId',
                        'options' => ['placeholder' => 'Select ...'],
                        //'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'class' => 'required form-control ',
                            'initialize' => true,
                            'depends' => ['pickingpoint-provinceid'],
                            'url' => Url::to(['child-amphur-address-picking-point']),
                            'loadingText' => 'Loading amphur ...',
                            'params' => ['input-type-11', 'input-type-22']
                        ]
                    ])->label('Amphur');
                }
                ?>
                <?php
                //echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
                ?>
            </div>
            <div id="lockers-picking" class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 3
                if ($ListOrderItemGroupLockersAction == 'isFalse') {
                    echo Html::hiddenInput('input-type-13', $pickingPointLockers->provinceId, ['id' => 'input-type-13']);
                    echo Html::hiddenInput('input-type-23', $pickingPointLockers->amphurId, ['id' => 'input-type-23']);
                    echo Html::hiddenInput('lockers-input-type-33', '2', ['id' => 'lockers-input-type-33']);
                } else {
                    echo Html::hiddenInput('input-type-13', $ListpickpointLockersValueInLocation['pickingId'], ['id' => 'input-type-13']);
                    echo Html::hiddenInput('input-type-23', $ListpickpointLockersValueInLocation['pickingId'], ['id' => 'input-type-23']);
                    echo Html::hiddenInput('lockers-input-type-33', '2', ['id' => 'lockers-input-type-33']);
                }

                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointLockers, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...'],
                        'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        //'pluginEvents' => [
                        //"depdrop.afterChange" => "function(event, id, value) { console.log('value: ' + value + ' id: ' + id); }"
                        //],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['pickingpoint-amphurid'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23', 'lockers-input-type-33']
                        ]
                    ])->label('picking point');
                } else {
                    echo $form->field($pickingPointLockers, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...'],
                        //'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['pickingpoint-amphurid'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23', 'lockers-input-type-33']
                        ]
                    ])->label('picking point');
                }
                ?>
                <?php
                //echo Html::hiddenInput("pickingDDId", $pickingId, ['id' => "pickingDDId"]);
                echo Html::hiddenInput("receiveTypeLockers", '2', ['id' => "receiveTypeLockers"]);
                ?>
            </div>
            <?php
            if ($LockersHistoryLockersNoti == 'isTrue') {
                ?>
                <div class="col-md-12 history-lockers-null">
                    <h5 class="cs-heading" style="font-size: 14px; color: #166db9;"><i class="fa fa-bullhorn" aria-hidden="true" style="color: #166db9;"></i> แจ้งเตือนประวัติสถานที่รับสินค้า : ปลายทางที่ล็อคเกอร์ร้อน </h5>
                    <blockquote style="font-size: 16px;">
                        <p style="color: #8c8c8c;">สถานที่รับสินค้าล่าสุดที่ลูกค้าเคยเลือกไว้ หากลูกค้าต้องการเปลียนจุดรับสินค้า สามารถเปลียนได้จากด้านบน.</p>
                        <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                    </blockquote>
                </div>
                <?php
                $mapImages = $ListpickpointLockersValueInLocation['mapImages'];
                if (isset($mapImages)) {
                    ?>
                    <div class="col-md-12">
                        <h5 class="cs-heading" style="font-size: 14px;color: #166db9;">
                            <i class="fa fa-map-marker" aria-hidden="true" style="color: #166db9;"></i> แผนที่ : ปลายทางที่ล็อคเกอร์ร้อน  (<span class="name-lockers" style="color: #2ca02c;"></span>) </h5>
                        <blockquote style="font-size: 16px;">
                            <p class="description-lockers" style="color: #000000;"></p>
                            <p class="view-map-images-lockers" style="color: #8c8c8c;">
                                <?php
                                echo '<img src="' . $baseUrl . '/images/icon/loader.gif" class="img-responsive">';
                                //echo 'mapImages :' . $mapImages;
                                //echo '<img src="' . $baseUrl . $mapImages . '" class="img-responsive" style="width: 45% ">';
                                ?>
                            </p>
                            <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                        </blockquote>
                    </div>
                    <!--<div class="col-md-12">
                        <h5 class="cs-heading" style="font-size: 14px;color: #166db9;"><i class="fa fa-map-marker" aria-hidden="true" style="color: #166db9;"></i> แผนที่ : ปลายทางที่บูธ </h5>
                        <blockquote style="font-size: 16px;">
                            <p style="color: #8c8c8c; ">
                    <?php
                    //echo 'mapImages :' . $mapImages;
                    //echo '<img src="' . $baseUrl . $mapImages . '" class="img-responsive" style="width: 45% ">';
                    ?>
                            </p>
                            <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                        </blockquote>
                    </div>-->
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    } else {
        // echo $countType;
        //echo 'ทดสอบการทำงาน : Locker';
        //echo '<img src=\"' . Yii::$app->homeUrl . '/images/picking-point/booth.jpeg\" class=\"img-responsive\">';
        if ($countType == 1) {
            //echo '<div id="booth-null" class="col-lg-12 col-md-12 col-sm-12">';
            //echo '<h5> <i class="fa fa-align-left" aria-hidden="true" style="color: rgba(255,212,36,.9);"></i> สินค้าสำหรับบางประเภท</h5>';
            //echo '<img src="' . $baseUrl . '/images/picking-point/lockers.png" class="img-responsive"  style="opacity: .4;">';
            //echo '</div>';
        }
    }
    if ($value->receiveType == '1') {//ประเภทปลายทางแบบล็อคเกอร์เย็น
        //echo 'ประเภทปลายทางแบบล็อคเกอร์เย็น';
        ?>
        <div id="lockers-cool-status-1" class="col-lg-12 col-md-12 col-sm-12">
            <h5><i class="fa fa-align-justify" aria-hidden="true"></i> Shipping destination: CozxyBox</h5>
            <hr>
            <div id="lockers-province" class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 1
                // Additional input fields passed as params to the child dropdown's pluginOptions
                echo Html::hiddenInput('input-type-1', $ListpickpointLockersCoolValueInLocation['provinceId'], ['id' => 'input-type-1']);
                echo Html::hiddenInput('input-type-2', $ListpickpointLockersCoolValueInLocation['provinceId'], ['id' => 'input-type-2']);
                echo $form->field($pickingPointLockersCool, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                    'model' => $pickingId,
                    'attribute' => 'provinceId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()
                    ->join("RIGHT JOIN", "$dbName[1].picking_point", "picking_point.provinceId = states.stateId ")
                    ->where("states.countryId = 'THA' AND picking_point.type = 1")->asArray()->all(), 'stateId', 'localName'),
                    'pluginOptions' => [
                        'placeholder' => 'Select...',
                        'loadingText' => 'Loading province ...',
                        'params' => ['input-type-1', 'input-type-2']
                    ],
                    'options' => ['placeholder' => 'Select states ...', 'id' => 'LcprovinceId']
                ])->label('Province');
                ?>
                <?php
                //echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
                ?>
            </div>
            <div id="lockers-amphur" class="form-group col-lg-6 col-md-6 col-sm-6 ">
                <?php
                // Child level 2
                echo Html::hiddenInput('input-type-11', $ListpickpointLockersCoolValueInLocation['amphurId'], ['id' => 'input-type-11']);
                echo Html::hiddenInput('input-type-22', $ListpickpointLockersCoolValueInLocation['amphurId'], ['id' => 'input-type-22']);
                //echo $yourbrowser;
                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointLockersCool, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'amphurId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'LcamphurId'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                        'pluginOptions' => [
                            'class' => 'required',
                            'initialize' => true,
                            'depends' => ['LcprovinceId'],
                            'url' => Url::to(['child-amphur-address-picking-point']),
                            'loadingText' => 'Loading amphur ...',
                            'params' => ['input-type-11', 'input-type-22']
                        ]
                    ])->label('Amphur');
                } else {
                    echo $form->field($pickingPointLockersCool, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'amphurId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'LcamphurId'],
                        //'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => [ 'pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'class' => 'required form-control',
                            'initialize' => true,
                            'depends' => ['LcprovinceId'],
                            'url' => Url::to(['child-amphur-address-picking-point']),
                            'loadingText' => 'Loading amphur ...',
                            'params' => ['input-type-11', 'input-type-22']
                        ]
                    ])->label('Amphur');
                }
                ?>
                <?php
                //echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
                ?>
            </div>
            <div id="lockers-picking" class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 3
                if ($ListOrderItemGroupLockersCoolAction == 'isFalse') {
                    echo Html::hiddenInput('input-type-13', $pickingPointLockersCool->provinceId, ['id' => 'input-type-13']);
                    echo Html::hiddenInput('input-type-23', $pickingPointLockersCool->amphurId, ['id' => 'input-type-23']);
                    echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                } else {
                    echo Html::hiddenInput('input-type-13', $ListpickpointLockersCoolValueInLocation['pickingId'], ['id' => 'input-type-13']);
                    echo Html::hiddenInput('input-type-23', $ListpickpointLockersCoolValueInLocation['pickingId'], ['id' => 'input-type-23']);
                    echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
                }

                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointLockersCool, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId'],
                        'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        //'pluginEvents' => [
                        //"depdrop.afterChange" => "function(event, id, value) { console.log('value: ' + value + ' id: ' + id); }"
                        //],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['LcamphurId'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33']
                        ]
                    ])->label('picking point');
                } else {
                    echo $form->field($pickingPointLockersCool, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId'],
                        //'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['LcamphurId'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33']
                        ]
                    ])->label('picking point');
                }
                ?>
                <?php
                //echo Html::hiddenInput("pickingDDId", $pickingId, ['id' => "pickingDDId"]);
                echo Html::hiddenInput("receiveTypeLockersCool", '1', ['id' => "receiveTypeLockersCool"]);
                ?>
            </div>
            <?php
            if ($LockersCoolHistoryLockersNoti == 'isTrue') {
                ?>
                <div class="col-md-12 history-lockers-cool-null">
                    <h5 class="cs-heading" style="font-size: 14px; color: #166db9;"><i class="fa fa-bullhorn" aria-hidden="true" style="color: #166db9;"></i> History   : Shipping destination: CozxyBox </h5>
                    <blockquote style="font-size: 16px;">
                        <p style="color: #8c8c8c;">สถานที่รับสินค้าล่าสุดที่ลูกค้าเคยเลือกไว้ หากลูกค้าต้องการเปลียนจุดรับสินค้า สามารถเปลียนได้จากด้านบน.</p>
                        <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                    </blockquote>
                </div>
                <?php
                $mapImages = $ListpickpointLockersCoolValueInLocation['mapImages'];
                if (isset($mapImages)) {
                    ?>
                    <div class="col-md-12">
                        <h5 class="cs-heading" style="font-size: 14px;color: #166db9;">
                            <i class="fa fa-map-marker" aria-hidden="true" style="color: #166db9;"></i> Map : Shipping destination: CozxyBox  (<span class="name-lockers-cool" style="color: #2ca02c;"></span>) </h5>
                        <blockquote style="font-size: 16px;">
                            <p class="description-lockers-cool" style="color: #000000;"></p>
                            <p class="view-map-images-lockers-cool" style="color: #8c8c8c;">
                                <?php
                                echo '<img src="' . $baseUrl . '/images/icon/loader.gif" class="img-responsive">';
                                //echo 'mapImages :' . $mapImages;
                                //echo '<img src="' . $baseUrl . $mapImages . '" class="img-responsive" style="width: 45% ">';
                                ?>
                            </p>
                            <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                        </blockquote>
                    </div>
                    <!--<div class="col-md-12">
                        <h5 class="cs-heading" style="font-size: 14px;color: #166db9;"><i class="fa fa-map-marker" aria-hidden="true" style="color: #166db9;"></i> แผนที่ : ปลายทางที่บูธ </h5>
                        <blockquote style="font-size: 16px;">
                            <p style="color: #8c8c8c; ">
                    <?php
                    //echo 'mapImages :' . $mapImages;
                    //echo '<img src="' . $baseUrl . $mapImages . '" class="img-responsive" style="width: 45% ">';
                    ?>
                            </p>
                            <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                        </blockquote>
                    </div>-->
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    }
    /*
     * ปลายทางรับของที่ Booth
     */
    if ($value->receiveType == '3') {//ประเภทปลายทางแบบบูธ
        //echo 'ประเภทปลายทางแบบล็อคเกอร์เย็น';
        // Booth
        //$ListOrderItemGroupBoothValue = $CheckValuePickPoint['ListOrderItemGroupBoothValue'];
        //$ListOrderItemGroupBoothAction = $CheckValuePickPoint['ListOrderItemGroupBoothAction'];
        //$ListpickpointBoothValueInLocation = $CheckValuePickPoint['ListpickpointBoothValueInLocation'];
        //echo 'Lockers provinceId :' . $ListpickpointBoothValueInLocation['provinceId'];
        //echo 'Lockers amphurId :' . $ListpickpointBoothValueInLocation['amphurId'] . '<br>';
        //echo 'Lockers pickingId :' . $ListpickpointBoothValueInLocation['pickingId'] . '<br>';
        ?>
        <div id="booth-status-3" class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 10px;">
            <h5 class="shipment-title"><i class="fa fa-align-justify" aria-hidden="true"></i> เลือกสถานที่รับของ : ปลายทางที่บูธ</h5>
            <hr>
            <div id="booth-province" class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 1
                // Additional input fields passed as params to the child dropdown's pluginOptions
                echo Html::hiddenInput('booth-input-type-1', $ListpickpointBoothValueInLocation['provinceId'], ['id' => 'booth-input-type-1']);
                echo Html::hiddenInput('booth-input-type-2', $ListpickpointBoothValueInLocation['provinceId'], ['id' => 'booth-input-type-2']);
                echo $form->field($pickingPointBooth, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                    'model' => $pickingId,
                    'attribute' => 'provinceId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()
                    ->join("RIGHT JOIN", "$dbName[1].picking_point", "picking_point.provinceId = states.stateId ")
                    ->where("states.countryId = 'THA' AND picking_point.type = 3")->asArray()->all(), 'stateId', 'localName'),
                    'pluginOptions' => [
                        'placeholder' => 'Select...',
                        'loadingText' => 'Loading states ...',
                        'params' => ['booth-input-type-1', 'booth-input-type-2']
                    ],
                    'options' => ['placeholder' => 'Select states ...', 'id' => 'BprovinceId']
                ])->label('Province');
                ?>
                <?php
                //echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
                ?>
            </div>
            <div id="booth-amphur" class="form-group col-lg-6 col-md-6 col-sm-6 ">
                <?php
                // Child level 2
                echo Html::hiddenInput('booth-input-type-11', $ListpickpointBoothValueInLocation['amphurId'], ['id' => 'booth-input-type-11']);
                echo Html::hiddenInput('booth-input-type-22', $ListpickpointBoothValueInLocation['amphurId'], ['id' => 'booth-input-type-22']);
                //echo Html::hiddenInput('booth-input-type-33', '2', ['id' => 'booth-input-type-33']);
                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointBooth, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'amphurId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'BamphurId'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                        'pluginOptions' => [
                            'class' => 'required ',
                            'initialize' => true,
                            'depends' => ['BprovinceId'],
                            'url' => Url::to(['child-amphur-address-picking-point']),
                            'loadingText' => 'Loading amphur ...',
                            'params' => ['booth-input-type-11', 'booth-input-type-22']
                        ]
                    ])->label('Amphur');
                } else {
                    echo $form->field($pickingPointBooth, 'amphurId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'amphurId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'BamphurId'],
                        //'type' => DepDrop::TYPE_SELECT2,
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'class' => 'required form-control ',
                            'initialize' => true,
                            'depends' => ['Bprovinceid'],
                            'url' => Url::to(['child-amphur-address-picking-point']),
                            'loadingText' => 'Loading amphur ...',
                            'params' => ['booth-input-type-11', 'booth-input-type-22']
                        ]
                    ])->label('Amphur');
                }
                ?>
                <?php
                //echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
                ?>
            </div>
            <div id="booth-picking" class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 3

                if ($ListOrderItemGroupBoothAction == 'isFalse') {
                    echo Html::hiddenInput('booth-input-type-13', $pickingPointBooth->provinceId, ['id' => 'booth-input-type-13']);
                    echo Html::hiddenInput('booth-input-type-23', $pickingPointBooth->amphurId, ['id' => 'booth-input-type-23']);
                    echo Html::hiddenInput('booth-input-type-33', '3', ['id' => 'booth-input-type-33']);
                } else {
                    echo Html::hiddenInput('booth-input-type-13', $ListpickpointBoothValueInLocation['pickingId'], ['id' => 'booth-input-type-13']);
                    echo Html::hiddenInput('booth-input-type-23', $ListpickpointBoothValueInLocation['pickingId'], ['id' => 'booth-input-type-23']);
                    echo Html::hiddenInput('booth-input-type-33', '3', ['id' => 'booth-input-type-33']);
                    $pickingIds = $ListpickpointBoothValueInLocation['pickingId'];
                }
                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointBooth, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'BpickingId',],
                        'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'pluginEvents' => [
                        ],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['BamphurId'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['booth-input-type-13', 'booth-input-type-23', 'booth-input-type-33']
                        ]
                    ])->label('picking point');
                } else {
                    echo $form->field($pickingPointBooth, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'BpickingId',],
                        //'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'pluginEvents' => [
                        ],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['BamphurId'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['booth-input-type-13', 'booth-input-type-23', 'booth-input-type-33']
                        ]
                    ])->label('picking point');
                }
                ?>
                <?php
                //echo Html::hiddenInput("pickingDDId", $pickingId, ['id' => "pickingDDId"]);
                echo Html::hiddenInput("receiveTypeBooth", '3', ['id' => "receiveTypeBooth"]);
                ?>
            </div>
            <?php
            if ($BoothHistoryBoothNoti == 'isTrue') {
                ?>
                <div class="col-md-12 history-booth-null">
                    <h5 class="cs-heading" style="font-size: 14px;color: #166db9;"><i class="fa fa-bullhorn" aria-hidden="true" style="color: #166db9;"></i> แจ้งเตือนประวัติสถานที่รับสินค้า : ปลายทางที่บูธ </h5>
                    <blockquote style="font-size: 16px;">
                        <p style="color: #8c8c8c;">สถานที่รับสินค้าล่าสุดที่ลูกค้าเคยเลือกไว้ หากลูกค้าต้องการเปลียนจุดรับสินค้า สามารถเปลียนได้จากด้านบน.</p>
                        <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                    </blockquote>
                </div>
                <?php
                $mapImages = $ListpickpointBoothValueInLocation['mapImages'];
                if (isset($mapImages)) {
                    ?>
                    <div class="col-md-12 ">
                        <h5 class="cs-heading" style="font-size: 14px;color: #166db9;">
                            <i class="fa fa-map-marker" aria-hidden="true" style="color: #166db9;"></i> แผนที่ : ปลายทางที่บูธ (<span class="name-booth" style="color: #2ca02c;"></span>) </h5>
                        <blockquote style="font-size: 16px;">
                            <p class="description-booth" style="color: #000000;"></p>
                            <p class="view-map-images-booth" style="color: #8c8c8c;">
                                <?php
                                echo '<img src="' . $baseUrl . '/images/icon/loader.gif" class="img-responsive">';
                                //echo 'mapImages :' . $mapImages;
                                //echo '<img src="' . $baseUrl . $mapImages . '" class="img-responsive" style="width: 45% ">';
                                ?>
                            </p>
                            <footer style="color: rgba(255,212,36,.9);">Cozxy.Com</footer>
                        </blockquote>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    } else {
        if ($countType == 1) {
            //echo '<div id="booth-null" class="col-lg-12 col-md-12 col-sm-12">';
            //echo '<h5> <i class="fa fa-align-left" aria-hidden="true" style="color: rgba(255,212,36,.9);"></i> สินค้าสำหรับบางประเภท</h5>';
            //echo '<img src="' . $baseUrl . '/images/picking-point/booth.png" class="img-responsive" style="opacity: .4;">';
            //echo '</div>';
        }
    }
}
?>

<div class="form-group col-lg-12 col-md-12 col-sm-12">
    <?php
    //echo Html::submitButton('Save', ['class' => "btn btn-success createPickingSave", 'name' => 'btn-createPickingSave']);
    //echo Html::a("Cancel", "#", ['class' => "btn btn-danger createPickingCancel"]);
    ?>
</div>

<?php ActiveForm::end(); ?>
