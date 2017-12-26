<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$form = ActiveForm::begin([
            'id' => 'default-shipping-address-xx',
            //'action' => Yii::$app->homeUrl . 'checkout/summary',
            'action' => '#',
                //'options' => ['class' => 'space-bottom'],
                //'enableClientValidation' => false,
        ]);
?>
<div class="col-md-12 col-xs-12">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Select Province</label>
        <div class="col-sm-6">
            <?php
            //echo $form->field($pickingPoint, 'provinceId')->textInput();
            $a = "ssssss";
            echo $form->field($pickingPoint, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                //'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                //'data' => \common\models\costfit\PickingPoint::availableProvince(),
                'data' => yii\helpers\ArrayHelper::map(common\models\costfit\PickingPoint::availableProvince(), 'stateId', function($stateId) {
                            return \common\models\costfit\PickingPoint::provinceName($stateId);
                        }),
                'hideSearch' => true,
                'pluginOptions' => [
                    'placeholder' => 'Select Province',
                    'loadingText' => 'Loading Province ...',
                    'allowClear' => true
                ],
                'options' => ['placeholder' => 'Select Province ...',
                    'name' => 'PickingPoint[provinceId]', 'id' => 'stateId'],
            ])->label(FALSE);
            ?>
        </div>
    </div>
</div>
<div class="col-md-12 col-xs-12">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Select District</label>
        <div class="col-sm-6">
            <?php
            ///throw new \yii\base\Exception(1111);
            echo Html::hiddenInput('input-type-11', $pickingPoint->amphurId, ['id' => 'input-type-11']);
            echo Html::hiddenInput('input-type-22', $pickingPoint->amphurId, ['id' => 'input-type-22']);
            if (isset($pickingPoint->amphurId)) {
                //echo 'edit';
                echo Html::hiddenInput('input-type-33', 'edit', ['id' => 'input-type-33']);
            } else {
                //echo 'add';
                echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
            }

            echo $form->field($pickingPoint, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => isset($pickingPoint->amphurId) ? [$pickingPoint->amphurId => $pickingPoint->citie->localName . '/' . $pickingPoint->citie->cityName] : [],
                'options' => ['placeholder' => 'Select ...', 'name' => 'PickingPoint[amphurId]', 'id' => 'amphurId'],
                'type' => DepDrop::TYPE_DEFAULT,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['stateId'],
                    'url' => Url::to(['child-amphur-address-picking-point-checkouts']),
                    'loadingText' => 'Loading amphur ...',
                    'params' => ['input-type-11', 'input-type-22', 'input-type-33'],
                    'initialize' => TRUE,
                ]
            ])->label(FALSE);
            ?>
        </div>
    </div>
</div>
<div class="col-md-12 col-xs-12">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Select Cozxybox</label>
        <div class="col-sm-6">
            <?php
            echo Html::hiddenInput('input-type-13', $pickingPoint->provinceId, ['id' => 'input-type-13']);
            echo Html::hiddenInput('input-type-23', $pickingPoint->amphurId, ['id' => 'input-type-23']);
            echo Html::hiddenInput('picking-point-33', $pickingPoint->pickingId, ['id' => 'picking-point-33']);
            echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
            echo $form->field($pickingPoint, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                //'model' => $pickingId,
                //'data' => [$pickingPoint->pickingId => $pickingPoint->title],
                'attribute' => 'pickingId',
                'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'PickingPoint[pickingId]'],
                'type' => DepDrop::TYPE_DEFAULT,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['amphurId'],
                    'url' => Url::to(['child-picking-point-map']),
                    'loadingText' => 'Loading picking point ...',
                    'params' => ['input-type-13', 'input-type-23', 'picking-point-33', 'lockers-cool-input-type-33'],
                    'initialize' => TRUE,
                ]
            ])->label(FALSE);
            ?>
        </div>
    </div>
</div>
<div class=" text-center" style="margin-top: 10px;">
    <!--/*onclick="shipCozxyBox()"*/-->
    <!--<button type="button" class="btn btn-default btn-lg" id="shipCozxyBox-Map">
        &nbsp;&nbsp;&nbsp;&nbsp;SEARCH&nbsp;&nbsp;&nbsp;&nbsp;
    </button>-->
</div>

<?php ActiveForm::end(); ?>

