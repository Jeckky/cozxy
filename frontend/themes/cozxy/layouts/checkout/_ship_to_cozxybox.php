<div class="cart-detail" id="shipToCozxyBox">
    <h3>Ship to CozxyBox</h3>
    <div class="row fc-g999">
        <div class="col-md-4 col-xs-12">
            <?php
            echo $form->field($model, 'provinceId')->widget(kartik\select2\Select2::classname(), [
                'data' => yii\helpers\ArrayHelper::map(common\models\dbworld\States::find()->asArray()->all(), 'stateId', 'localName'),
                'pluginOptions' => [
                    'placeholder' => 'Select...',
                    'loadingText' => 'Loading States ...',
                ],
                'options' => ['placeholder' => 'Select States ...', 'name' => 'provinceId', 'id' => 'stateId'],
            ])->label(FALSE);
            ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?php
            echo Html::hiddenInput('input-type-11', $model->amphurId, ['id' => 'input-type-11']);
            echo Html::hiddenInput('input-type-22', $model->amphurId, ['id' => 'input-type-22']);
            echo Html::hiddenInput('input-type-33', 'add', ['id' => 'input-type-33']);
            echo $form->field($model, 'amphurId')->widget(DepDrop::classname(), [
                //'data' => [9 => 'Savings'],
                'options' => ['placeholder' => 'Select ...', 'name' => 'amphurId', 'id' => 'amphurId'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['stateId'],
                    'url' => Url::to(['child-amphur-address-picking-point-checkouts']),
                    'loadingText' => 'Loading amphur ...',
                    'params' => ['input-type-11', 'input-type-22', 'input-type-33'],
                    //                                        'initialize' => false,
                ]
            ])->label(FALSE);
            ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?php
            echo Html::hiddenInput('input-type-13', $pickingPointLockersCool->provinceId, ['id' => 'input-type-13']);
            echo Html::hiddenInput('input-type-23', $pickingPointLockersCool->amphurId, ['id' => 'input-type-23']);
            echo Html::hiddenInput('lockers-cool-input-type-33', '1', ['id' => 'lockers-cool-input-type-33']);
            echo $form->field($pickingPointLockersCool, 'pickingId')->widget(kartik\depdrop\DepDrop::classname(), [
                'model' => $pickingId,
                'attribute' => 'pickingId',
                'options' => ['placeholder' => 'Select ...', 'id' => 'LcpickingId', 'name' => 'LcpickingId'],
                'type' => DepDrop::TYPE_SELECT2,
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['amphurId'],
                    'url' => Url::to(['child-picking-point']),
                    'loadingText' => 'Loading picking point ...',
                    'params' => ['input-type-13', 'input-type-23', 'lockers-cool-input-type-33'],
                    //                                        'initialize' => false,
                ]
            ])->label(FALSE);
            ?>
        </div>
    </div>

    <div class="size18">&nbsp;</div>

    <div class="row fc-g999">
        <div class="col-xs-12">
            <h4>Map</h4>
            <div id="map" style="height:200px;"></div>

        </div>
    </div>
</div>