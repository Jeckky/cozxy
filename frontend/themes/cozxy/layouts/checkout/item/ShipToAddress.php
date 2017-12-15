<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
?>
<div class="col-md-3">
    <?php
    echo $form->field($order, 'shippingProvinceId')->widget(kartik\select2\Select2::classname(), [
        //'options' => ['id' => 'address-countryid'],
        'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId='THA' AND stateId in (1,2,3,58,4,59)")->orderBy('localName')->asArray()->all(), 'stateId', function($stateId) {
                    return \common\models\costfit\PickingPoint::provinceName($stateId);
                }),
        'hideSearch' => true,
        'pluginOptions' => [
            'placeholder' => 'Select province',
            'loadingText' => 'Loading Province ...',
        ],
        'options' => ['placeholder' => 'Select Province ...'],
    ])->label(FALSE);
    ?>
</div>
<div class="col-md-3">
    <?php
    echo Html::hiddenInput('input-type-11', $order->shippingAmphurId, ['id' => 'input-type-11']);
    echo Html::hiddenInput('input-type-22', $order->shippingAmphurId, ['id' => 'input-type-22']);
    echo Html::hiddenInput('input-type-33', '1', ['id' => 'input-type-33']);
    echo $form->field($order, 'shippingAmphurId')->widget(DepDrop::classname(), [
        //'data' => [$order->shippingAmphurId => $order->shippingCities->localName],

        'options' => ['placeholder' => 'Select Amphur'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
//                                            'initialize' => true,
            'depends' => ['order-shippingprovinceid'],
            'url' => Url::to(['child-amphur-address']),
            'loadingText' => 'Loading amphur ...',
            'params' => ['input-type-11', 'input-type-22', 'input-type-33']
        ]
    ])->label(FALSE);
    ?>
</div>
<div class="col-md-3">
    <?php
    echo Html::hiddenInput('input-type-13', $order->shippingDistrictId, ['id' => 'input-type-13']);
    echo Html::hiddenInput('input-type-33', $order->shippingDistrictId, ['id' => 'input-type-33']);
    echo Html::hiddenInput('input-type-34', '1', ['id' => 'input-type-34']);
    echo $form->field($order, 'shippingDistrictId')->widget(DepDrop::classname(), [
        //'data' => [$order->shippingDistrictId => $order->shippingDistrict->localName],

        'options' => ['placeholder' => 'Select District'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            //'initialize' => true,
            'depends' => ['order-shippingamphurid'],
            'url' => Url::to(['child-district-address']),
            'loadingText' => 'Loading district ...',
            'params' => ['input-type-13', 'input-type-33', 'input-type-34']
        ]
    ])->label(FALSE);
    ?>
</div>
<div class="col-md-3">
    <?php
    echo $form->field($order, 'shippingZipcode')->widget(DepDrop::classname(), [
        'data' => [$order->shippingZipcode => $order->shippingZipcode],
        'options' => ['placeholder' => 'Select ...'],
        'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['order-shippingdistrictid'],
            //                                            'initialize' => true,
            //'initDepends' => ['address-countryid'],
            'url' => Url::to(['child-zipcode-address']),
            'loadingText' => 'Loading zipcode ...',
            'params' => ['input-type-14', 'input-type-42', 'input-type-42']
        ]
    ])->label(FALSE);
    ?>
</div>