<div class="cart-detail login-box" id="shipToAddress">
    <h3>Ship to address <span class="small text-danger">(require all fields)</span></h3>

    <div class="row">
        <div class="col-md-6">
            <?php // throw new \yii\base\Exception($model->scenario); ?>
            <?= $form->field($model, 'firstname')->textInput(['class' => 'fullwidth', 'placeholder' => 'FIRSTNAME'])->label(false); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'lastname')->textInput(['class' => 'fullwidth', 'placeholder' => 'LASTNAME'])->label(false); ?>
        </div>
    </div>

    <?= $form->field($model, 'address')->textarea(['class' => 'fullwidth', 'placeholder' => 'ADDRESS'])->label(false); ?>

    <div class="row">
        <div class="col-md-3">
            <?php
            echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                //'options' => ['id' => 'address-countryid'],
                'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->where("countryId='THA' AND stateId in (1,2,3,58,4,59)")->orderBy('localName')->asArray()->all(), 'stateId', 'localName'),
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
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...'],
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
            echo $form->field($model, 'districtId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
//                                            'initialize' => true,
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
            echo $form->field($model, 'zipcode')->widget(DepDrop::classname(), [
                //'data' => [12 => 'Savings A/C 2'],
                'options' => ['placeholder' => 'Select ...'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['order-shippingdistrictid'],
                    //'initialize' => true,
                    //'initDepends' => ['address-countryid'],
                    'url' => Url::to(['child-zipcode-address']),
                    'loadingText' => 'Loading zipcode ...',
                    'params' => ['input-type-14', 'input-type-42', 'input-type-42']
                ]
            ])->label(FALSE);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php // throw new \yii\base\Exception($model->scenario); ?>
            <?= $form->field($model, 'tel')->textInput(['class' => 'fullwidth', 'placeholder' => 'PHONE'])->label(false); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['class' => 'fullwidth', 'placeholder' => 'EMAIL'])->label(false); ?>
        </div>
    </div>

</div>