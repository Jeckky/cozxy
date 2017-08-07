<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
?>
<style>
    .select2-close-mask{
        z-index: 2099;
    }
    .select2-dropdown{
        z-index: 3051;
    }
</style>
<h1 class="page-header">Compare Price</h1>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 text-left">
            <i class="fa fa-align-justify" aria-hidden="true"></i> Currency Exchange Rate
        </div>
        <br>
        <div class="col-md-12 text-left sort-stories-currency" style="margin-top: 5px;">
            <?php
            // Templating example of formatting each list element
            $url = \Yii::$app->urlManager->baseUrl . '/images/flags/flags/flat/16/';
            $format = <<< SCRIPT
function format(state) {
           console.log(state);
    if (!state.id) return state.text.toLowerCase() ; // optgroup
    src = '$url' + 'Abkhazia' + '.png'
    //console.log(src);
    //return '<img class="flag" src="' + src + '"/> ' + state.text.toLowerCase() ;
    return  state.text.toLowerCase() ;
}
SCRIPT;
            $escape = new JsExpression("function(m) { return m; }");
            $this->registerJs($format, \yii\web\View::POS_HEAD);
            ?>
            <?php
            // Templating example of formatting each list element

            echo kartik\select2\Select2::widget([
                'name' => 'state_2',
                'value' => '',
                'data' => yii\helpers\ArrayHelper::map(common\models\costfit\CurrencyInfo::find()->where('status=2')->asArray()->all(), 'currencyId', function($model, $defaultValue) {
                    return $model['currrency_symbol'] . '-' . $model['ctry_name'];
                }, 'currency_code'),
                'options' => ['multiple' => FALSE, 'placeholder' => 'Select Currency ...', 'onchange' => 'CurrencyExchangeRate(this.value)'],
                'pluginOptions' => [
                    //'templateResult' => new JsExpression('format'),
                    //'templateSelection' => new JsExpression('format'),
                    //'escapeMarkup' => $escape,
                    'allowClear' => true
                ],
            /* , 'addon' => [
              'prepend' => [
              'content' => Html::icon('globe')
              ],
              'append' => [
              'content' => Html::button(Html::icon('map-marker'), [
              'class' => 'btn btn-primary',
              'title' => 'Mark on map',
              'data-toggle' => 'tooltip'
              ]),
              'asButton' => true
              ]
              ] */
            ]);
            ?>
        </div>
    </div>

    <div class="col-md-12 text-left sort-stories-compare" style="margin-top: 10px;">
        <div class="col-md-12 text-left"><i class="fa fa-align-left" aria-hidden="true"></i> Sort</div><br>
        <div class="col-md-12 text-left">
            <a href="javascript:sortStoriesCompare(this,'price', '<?= $productPost->productPostId
            ?>', '<?= $productPost->productId ?>')">
                Sort by price&nbsp;<i class="fa fa-angle-<?= isset($icon) ? $icon : 'down' ?>" aria-hidden="true"></i></a>
        </div>
        <input type="hidden" name="sortStoriesPrice" id="sortStoriesPrice" value="<?= isset($sort) ? $sort : 'SORT_ASC' ?>">
    </div>
</div>
<div class="size20">&nbsp;</div>

<div class="row" id="compare">
    <div class="col-md-12  " id="showData">
        <table class="table table-striped table-bordered " id="table-compare-price-cozxy">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Country</th>
                    <th>Place</th>
                    <th>Price</th>
                    <th>Local Price</th>
                    <th>Update Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $comparePrice,
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layouts/story/items/_compare_price_items', ['model' => $model, 'index' => $index]);
                    },
                    // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    'layout' => "{items}",
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>
            </tbody>
        </table>
        <input type="hidden" name="productPostId" id="productPostId" value="<?= $productPost->productPostId ?>">
        <input type="hidden" name="productId" id="productId" value="<?= $productPost->productId ?>">
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <?php
        $form = ActiveForm::begin([
            'id' => 'default-add-new-compare-price-story',
            'method' => 'POST',
            'options' => ['enctype' => 'multipart/form-data']
        ]);
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="gridSystemModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Compare Price</h4>
            </div>
            <!-- Cart -->
            <div class="row">
                <!-- Details -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="size24">&nbsp;</div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shop Name</label>
                            <?= $form->field($modelComparePrices, 'shopName')->textInput(['class' => 'form-control', 'placeholder' => 'Shop Name', 'id' => 'productpost-shopname'])->label(FALSE); ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label><!--฿-->
                                    <?= $form->field($modelComparePrices, 'price', ['template' => '
                                            <div class="col-sm-12" style="padding-left: 0px; padding-right: 0px;">
                                                <div class="input-group col-sm-12">
                                                   <span class="input-group-addon">

                                                   </span>
                                                   {input}
                                                </div>
                                                {error}{hint}
                                            </div>'])->textInput(['data-default' => ''])
                                    ?>
                                    <!--<div class="input-group">
                                        <div class="input-group-addon">฿</div>
                                        <?//= $form->field($modelComparePrices, 'price')->textInput([ 'class' => 'form-control', 'placeholder' => 'Price', 'id' => 'productpost-price'])->label(FALSE); ?>
                                        <div class="input-group-addon">.00</div>
                                    </div>-->
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                <?//= $form->field($modelComparePrices, 'price')->textInput([ 'class' => 'form-control', 'placeholder' => 'Price', 'id' => 'productpost-price'])->label(FALSE); ?>
                                </div>-->
                            </div>

                            <!--<div class="col-md-6">
                                <div class="form-group field-productpost-country" style="margin-top: 7px;">
                                    <label for="exampleInputEmail1">Country</label>
                            <?php
                            /* echo kartik\select2\Select2::widget([
                              'name' => 'countryModal',
                              'value' => '',
                              'data' => $country,
                              'options' => ['multiple' => FALSE, 'placeholder' => 'Select Country ...', 'id' => 'productpost-country']
                              ]); */
                            ?>
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>-->

                            <div class="col-md-12">
                                <div class="form-group field-productpost-currency"  style="margin-top: 7px;">
                                    <label for="exampleInputEmail1">Currency</label>
                                    <?php
                                    echo kartik\select2\Select2::widget([
                                        'name' => 'currencyModal',
                                        'value' => '',
                                        'data' => yii\helpers\ArrayHelper::map(common\models\costfit\CurrencyInfo::find()->asArray()->all(), 'currencyId', function($model, $defaultValue) {
                                            return $model['currrency_symbol'] . '-' . $model['ctry_name'];
                                        }, 'currency_code'),
                                        'options' => ['multiple' => FALSE, 'placeholder' => 'Select Currency ...', 'id' => 'productpost-currency']
                                    ]);
                                    ?>
                                    <?php
                                    /* echo kartik\select2\Select2::widget([
                                      'name' => 'currencyModal',
                                      'value' => '',
                                      'data' => $currency,
                                      'options' => ['multiple' => FALSE, 'placeholder' => 'Select Currency ...', 'id' => 'productpost-currency']
                                      ]); */
                                    ?>
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top: 7px;">
                                    <label for="exampleInputEmail1">Location Latitude</label>
                                    <?= $form->field($modelComparePrices, 'latitude')->textInput(['class' => 'form-control', 'placeholder' => 'Location (Lat)', 'id' => 'latitude'])->label(FALSE); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"  style="margin-top: 7px;">
                                    <label for="exampleInputEmail1">Location Longitude</label>
                                    <?= $form->field($modelComparePrices, 'longitude')->textInput(['class' => 'form-control', 'placeholder' => 'Location (Long)', 'id' => 'longitude'])->label(FALSE); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="size24">&nbsp;</div>
                </div>
            </div>
            <div id="productpost-productPostId"></div>
            <div class="modal-footer">
                <a href="#" class="b btn-black" style="padding:12px 32px; margin:24px auto 12px" data-dismiss="modal" aria-label="Close">CANCEL</a>
                &nbsp;
                <a href="javascript:ComparePriceStory()" class="b btn-yellow" id="acheckoutNewBillingz" data-loading-text="<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i> Processing Compare Price" style="padding:12px 32px; margin:24px auto 12px">Save</a>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>