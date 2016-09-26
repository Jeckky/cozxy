<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

$form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'validateOnSubmit' => true,
            'options' => ['class' => "space-bottom"],
        ]);

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
        height: 162px;
        overflow-y: auto;
    }

</style>
<div class=" col-lg-12 col-md-12 col-sm-12 main-list-picking-point">
    <?php for ($i = 0; $i < 10; $i++) { ?>
        <div class="col-lg-4 col-md-4 col-sm-4 ">
            <div class="tile address text-center" style="background-color: rgba(31, 30, 30, 0.03);">
                <div class="main-title-picking-point">
                    test's
                </div>
                <div class="footer-cost-fit">
                    <a class="panel-toggle" href="#NewShipping"><!--address1-->
                        <div class="radio light">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-sm btn-info checkout_select_address ">
                                    <input type="radio" name="checkout_select_address" value="xxx"> เลือก
                                </label>
                                <label class="btn btn-sm btn-black edit_select checkout_update_address " style="width: 38%;">
                                    <input type="hidden" id="edit-form-biiling-checkout" name="edit-form-biiling-checkout" value="">แก้ไข
                                </label>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="form-group col-lg-12 col-md-12 col-sm-12">
    <br>
</div>
<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
// Child level 1

    echo $form->field($address, 'provinceId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId = 'THA'")->asArray()->all(), 'stateId', 'stateName'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading states ...',
        ],
        'options' => ['placeholder' => 'Select states ...'],
    ])->label('เลือกจังหวัด');
    ?>
    <?php
    echo Html::hiddenInput("statesDDId", $stateId, ['id' => "statesDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
    // Child level 2
    echo $form->field($address, 'amphurId')->widget(DepDrop::classname(), [
        //'data' => [9 => 'Savings'],
        'options' => ['placeholder' => 'Select ...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'initialize' => true,
            'depends' => ['address-provinceid'],
            'url' => Url::to(['child-amphur-address-picking-point']),
            'loadingText' => 'Loading amphur ...',
            'params' => ['input-type-11', 'input-type-22']
        ]
    ])->label('เลือกอำเภอ/เขต');
    ?>
    <?php
    echo Html::hiddenInput("amphurDDId", $cityId, ['id' => "amphurDDId"]);
    ?>
</div>

<div class="form-group col-lg-6 col-md-6 col-sm-6">
    <?php
    echo $form->field($address, 'pickingId')->widget(kartik\select2\Select2::classname(), [
        'data' => yii\helpers\ArrayHelper::map(common\models\costfit\PickingPointItems::find()->asArray()->all(), 'pickingItemsId', 'name'),
        'pluginOptions' => [
            'placeholder' => 'Select...',
            'loadingText' => 'Loading picking items ...',
        ],
        'options' => ['placeholder' => 'Select states ...'],
    ])->label('เลือกจุดรับของ');
    ?>
</div>

<?php ActiveForm::end(); ?>