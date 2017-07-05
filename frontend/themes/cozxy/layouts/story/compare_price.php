<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<h1 class="page-header">Compare Price</h1>
<div class="row">
    <div class="col-md-6">
        <div class="col-md-12 text-left">
            <i class="fa fa-align-left" aria-hidden="true"></i> Currency Filter
        </div><br>
        <div class="col-md-9 text-center sort-stories-currency">
            <select id="currencyid" class="fullwidth input-sm" name="currencyId" onchange="sortStoriesCompare(this, 'currency', '<?= $productPost->productPostId ?>', '<?= $productPost->productId ?>')">
                <option value="">select currency</option>
                <?php
                foreach ($currency as $key => $value) {
                    ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                <?php } ?>
            </select>
            <input type="hidden" name="hiddenCurrencyId" id="hiddenCurrencyId" value="<?= isset($currencyId) ? $currencyId : '' ?>">
        </div>
    </div>

    <div class="col-md-4 text-left sort-stories-compare">
        <div class="col-md-12 text-left"><i class="fa fa-align-left" aria-hidden="true"></i> Sort</div><br>
        <div class="col-md-12 text-left">
            <a href="javascript:sortStoriesCompare(this,'price', '<?= $productPost->productPostId ?>', '<?= $productPost->productId ?>')">
                Sort by price&nbsp;<i class="fa fa-angle-down<?= isset($icon) ? $icon : '' ?>" aria-hidden="true"></i></a>
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
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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
                            <input type="text" id="productpost-shopname" class="form-control" name="ProductPost[shopName]" placeholder="Shop Name" autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" id="productpost-price" class="form-control" name="ProductPost[shopName]" placeholder="Price" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top: 7px;">
                                    <label for="exampleInputEmail1">Country</label>
                                    <?php
                                    echo kartik\select2\Select2::widget([
                                        'name' => 'countryModal',
                                        'value' => '',
                                        'data' => $country,
                                        'options' => ['multiple' => FALSE, 'placeholder' => 'Select Country ...', 'id' => 'productpost-country']
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"  style="margin-top: 7px;">
                                    <label for="exampleInputEmail1">Currency</label>
                                    <?php
                                    echo kartik\select2\Select2::widget([
                                        'name' => 'currencyModal',
                                        'value' => '',
                                        'data' => $currency,
                                        'options' => ['multiple' => FALSE, 'placeholder' => 'Select Currency ...', 'id' => 'productpost-currency']
                                    ]);
                                    ?>
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
                <a href="javascript:ComparePriceStory()" class="b btn-yellow" id="acheckoutNewBillingz" data-loading-text="<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i> Processing New Billing" style="padding:12px 32px; margin:24px auto 12px">Update</a>
            </div>

        </div>
    </div>
</div>