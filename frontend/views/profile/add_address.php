<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
// https://github.com/kartik-v/yii2-widget-depdrop //
?>

<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <h4>Default shipping address</h4>
    <?php
    $form = ActiveForm::begin([
                'id' => 'default-shipping-address',
                'options' => ['class' => 'space-bottom']
    ]);
    ?>
    <?php echo $form->field($model, 'company'); ?>
    <?php echo $form->field($model, 'address')->textarea(); ?>
    <?=
            $form->field($model, 'countryId')
            ->dropDownList(
                    yii\helpers\ArrayHelper::map(\common\models\dbworld\Countries::find()->all(), 'countryId', 'countryName'), ['prompt' => 'Select country']
                    , ['id' => 'address-countryid'])->label('Country')
    ?>


    <div class="form-group col-md-12">
        <label>จังหวัด</label>
        <?= Html::dropDownList("Search[stateId]", $model->provinceId, yii\helpers\ArrayHelper::map(\common\models\dbworld\States::find()->all(), 'stateId', 'stateName'), ['prompt' => '-- Select State --', 'class' => 'select2', 'onchange' => 'dynamicCity(this)', 'style' => 'width:90%']) ?>
        <div id="stateDdl">
            <?//= Html::dropDownList("Search[stateId]", NULL, [], ['prompt' => '-- Select State --', 'style' => 'width:90%', 'onmouseover' => 'dynamicState()']) ?>
        </div>

    </div>
    <?// =
    $form->field($model, 'provinceId')
    ->dropDownList(
    yii\helpers\ArrayHelper::map(\common\models\dbworld\States::find(), 'stateId', 'stateName'), ['prompt' => 'Select province']
    )->label('Province')
    ?>
    <div id="cityDdl">
        <?=
                $form->field($model, 'amphurId')
                ->dropDownList(
                        yii\helpers\ArrayHelper::map(\common\models\dbworld\Cities::find()->all(), 'cityId', 'cityName'), ['prompt' => 'Select amphur']
                )->label('Amphur')
        ?></div>
    <?php echo $form->field($model, 'tax'); ?>
    <?php echo $form->field($model, 'zipcode'); ?>
    <?php echo $form->field($model, 'tel'); ?>
    <?php echo $form->field($model, 'isDefault')->radioList([0 => 'Yes', 1 => 'No'], ['itemOptions' => ['class' => 'radio']])->label('isDefault address') ?>
    <?php echo Html::submitButton('Save shipping address', ['class' => 'btn btn-primary', 'name' => 'btn-shipping-address']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script>
    function dynamicCity(state)
    {
        $.ajax({
            type: 'GET',
            //datatype:'ajax',
            data: {stateId: state.value},
            url: '<?= yii\helpers\Url::to(Yii::$app->homeUrl . 'site/dynamic-city') ?>',
            success: function (data) {
                $("#cityDdl").html(data);
            }
        });
    }
</script>
