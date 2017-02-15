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

<div class="form-group col-lg-12 col-md-12 col-sm-12">
    <!--<br>
    <a class="panel-toggle" href="#PickingPoint"><i></i>New Picking Point</a>
    -->
</div>

<?php
foreach ($GetOrderMastersGroup as $value) {
    //echo $value->receiveType . '<br>';
    //echo 'GetOrderMastersGroup :: ' . count($value) . '<br>';
    if ($value->receiveType == '1') {
        // Lockers
        ?>
        <div id="lockers" class="col-lg-12 col-md-12 col-sm-12">
            <h5><i class="fa fa-align-justify" aria-hidden="true"></i> เลือกสถานที่รับของ : ล็อคเกอร์</h5>
            <hr>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 1
                // Additional input fields passed as params to the child dropdown's pluginOptions
                // echo Html::hiddenInput('input-type-1', $pickingPoint->provinceId, ['id' => 'input-type-1']);
                // echo Html::hiddenInput('input-type-2', $pickingPoint->provinceId, ['id' => 'input-type-2']);
                echo $form->field($pickingPointLockers, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                    'model' => $pickingId,
                    'attribute' => 'provinceId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
                    'pluginOptions' => [
                        'placeholder' => 'Select...',
                        'loadingText' => 'Loading states ...',
                    ],
                    'options' => ['placeholder' => 'Select states ...']
                ])->label('เลือกจังหวัด');
                ?>
                <?php
                //echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
                ?>
            </div>

            <div  class="form-group col-lg-6 col-md-6 col-sm-6 ">
                <?php
                // Child level 2
                //echo Html::hiddenInput('input-type-11', $pickingPoint->amphurId, ['id' => 'input-type-11']);
                //echo Html::hiddenInput('input-type-22', $pickingPoint->amphurId, ['id' => 'input-type-22']);
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
                    ])->label('เลือกอำเภอ/เขต');
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
                    ])->label('เลือกอำเภอ/เขต');
                }
                ?>
                <?php
                //echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
                ?>

            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 3
                echo Html::hiddenInput('input-type-13', $pickingPointLockers->provinceId, ['id' => 'input-type-13']);
                echo Html::hiddenInput('input-type-23', $pickingPointLockers->amphurId, ['id' => 'input-type-23']);
                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointLockers, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...'],
                        'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['pickingpoint-amphurid'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23']
                        ]
                    ])->label('เลือกจุดรับของ');
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
                            'params' => ['input-type-13', 'input-type-23']
                        ]
                    ])->label('เลือกจุดรับของ');
                }
                ?>
                <?php
                //echo Html::hiddenInput("pickingDDId", $pickingId, ['id' => "pickingDDId"]);
                ?>
            </div>
        </div>

        <?php
    } else if ($value->receiveType == '2') {
        // Booth
        ?>
        <div id="booth" class="col-lg-12 col-md-12 col-sm-12">
            <h5 class="shipment-title"><i class="fa fa-align-justify" aria-hidden="true"></i> เลือกสถานที่รับของ : บูธ</h5>
            <hr>
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 1
                // Additional input fields passed as params to the child dropdown's pluginOptions
                // echo Html::hiddenInput('input-type-1', $pickingPoint->provinceId, ['id' => 'input-type-1']);
                // echo Html::hiddenInput('input-type-2', $pickingPoint->provinceId, ['id' => 'input-type-2']);
                echo $form->field($pickingPointBooth, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                    'model' => $pickingId,
                    'attribute' => 'provinceId',
                    'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
                    'pluginOptions' => [
                        'placeholder' => 'Select...',
                        'loadingText' => 'Loading states ...',
                    ],
                    'options' => ['placeholder' => 'Select states ...', 'id' => 'BprovinceId']
                ])->label('เลือกจังหวัด');
                ?>
                <?php
                //echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
                ?>
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6 ">
                <?php
                // Child level 2
                //echo Html::hiddenInput('input-type-11', $pickingPoint->amphurId, ['id' => 'input-type-11']);
                //echo Html::hiddenInput('input-type-22', $pickingPoint->amphurId, ['id' => 'input-type-22']);
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
                            'params' => ['input-type-11', 'input-type-22']
                        ]
                    ])->label('เลือกอำเภอ/เขต');
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
                            'params' => ['input-type-11', 'input-type-22']
                        ]
                    ])->label('เลือกอำเภอ/เขต');
                }
                ?>
                <?php
                //echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
                ?>

            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                <?php
                // Child level 3
                echo Html::hiddenInput('input-type-13', $pickingPointBooth->provinceId, ['id' => 'input-type-13']);
                echo Html::hiddenInput('input-type-23', $pickingPointBooth->amphurId, ['id' => 'input-type-23']);
                if ($yourbrowser != 'Safari') {
                    echo $form->field($pickingPointBooth, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'BpickingId'],
                        'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['BamphurId'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23']
                        ]
                    ])->label('เลือกจุดรับของ');
                } else {
                    echo $form->field($pickingPointBooth, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                        //'data' => [9 => 'Savings'],
                        'model' => $pickingId,
                        'attribute' => 'pickingId',
                        'options' => ['placeholder' => 'Select ...', 'id' => 'BpickingId'],
                        //'type' => DepDrop::TYPE_SELECT2,
                        //'options' => ['multiple' => true],
                        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                        'pluginOptions' => [
                            'initialize' => true,
                            'depends' => ['BamphurId'],
                            'url' => Url::to(['child-picking-point']),
                            'loadingText' => 'Loading picking point ...',
                            'params' => ['input-type-13', 'input-type-23']
                        ]
                    ])->label('เลือกจุดรับของ');
                }
                ?>
                <?php
                //echo Html::hiddenInput("pickingDDId", $pickingId, ['id' => "pickingDDId"]);
                ?>
            </div>
        </div>

        <?php
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