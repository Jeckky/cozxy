<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;

//use kartik\rating\StarRating;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<link href="<?php echo $directoryAsset; ?>/masterslider/style/masterslider.css" rel="stylesheet">

<style>
    .popover-content {
        color: red;
        /*background-color: red;*/
        font-size: 10px;
        padding: 10px;
    }
    .popover .popover-content {
        border: none !important;
        text-align: left !important;
        padding: 5 !important;
        font-size: .875em !important;
    }
    .priceActive  > thead > tr{
        border-top: 3px #3cc solid;
        background-color: rgba(51,204,204,.15);
        color: purple;
    }
    .priceActive > tbody > tr{
        background-color: rgba(51,204,204,.15);
        color: purple;
    }
    .checkbox label {
        min-height: 1em;
        padding-left: 10px;
        margin-bottom: 0;
        font-weight: normal;
        cursor: pointer;
    }

    /* Popover */
    .popover {
        /* border: 2px dotted red;*/
        padding: 15px;

    }

    /* Popover Header */
    .popover-title {
        background-color: #73AD21;
        color: #FFFFFF;
        font-size: 28px;
        text-align:center;
    }

    /* Popover Body */
    .popover-content {

        color: red;
        padding: 25px;
    }

    /* Popover Arrow */
    .arrow {
        /* border-right-color: red !important;*/

    }
</style>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: rgba(255,212,36,.9); text-align: right; color: #000000; padding: 5px;"> Story by : <?= $productPost->user->email; ?></div>
    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
        <?php echo $this->render('_product_image_rating', ['model' => $model, 'productSupplierId' => $productSupplierId]); ?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 text-center">
            <div class="col-lg-12 col-md-3 text-center"></div>
            <div class="col-lg-12 col-md-6 text-center">
                <br>
                <h4>  <?= $model->title; ?></h4>
                <?php
                //if ($modelSupp->result != 0) {
                ?>

                <?= Html::hiddenInput("fastId", $fastId = common\models\costfit\Product::getShippingTypeId($model->productId), ['id' => 'fastId']); ?>
                <?= Html::hiddenInput("productId", $model->productId, ['id' => 'productId']); ?>
                <?= Html::hiddenInput("supplierId", $modelSupp->userId, ['id' => 'supplierId']); ?>
                <?= Html::hiddenInput("productSuppId", $model->productSuppId, ['id' => 'productSuppId']); ?>
                <?= Html::hiddenInput("receiveType", $modelSupp->receiveType, ['id' => 'receiveType']); ?>
                <div class="buttons group">
                    <input type="hidden" id="maxQnty" value="<?= $model->findMaxQuantitySupplier($model->productSuppId) ?>">
                    <?php
                    if ($modelSupp->result != 0) {
                        ?>
                        <div class="qnt-count">
                            <a class="incr-btn" href="#">-</a>
                            <input id="quantity" class="form-control" type="text" value="<?= ($model->findMaxQuantity($model->productSuppId) == 0) ? 0 : 1 ?>">
                            <a class="incr-btn" href="#" data-toggle="popover" data-content="Max Quantity For this Item" data-placement="bottom">+</a>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    //if ($modelSupp->result != 0) {
                    ?>
                    <a class="btn btn-primary btn-sm" id="addItemToCartUnity" href="#" <?= ($model->findMaxQuantity($model->productSuppId) <= 0) ? " disabled" : " " ?>><i class="icon-shopping-cart"></i>Add to cart</a>
                    <?php //} ?>
                    <!--<a class="btn btn-black btn-sm" <?php //if (\Yii::$app->user->isGuest == 1) {               ?> id="GuestaddItemToWishlist" <?php //} else {               ?> id="addItemToWishlist" <?php //}               ?> href="#" <?//= (\common\models\costfit\Wishlist::isExistingList($model->productSuppId)) ? " disabled" : " " ?>><i class="icon-heart"></i>Add to wishlist</a>-->
                </div>
                <?php //} ?>
                <hr>
                <!--<h5 class="text-right">  Story by : <?//= $productPost->user->email; ?></h5>-->
                <h2><?= $productPost->title; ?></h2>
                <h3><?= $productPost->shortDescription; ?></h3>
            </div>
            <div class="col-lg-12 col-md-3 text-center"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="col-lg-12 col-md-3 text-center"></div>
        <div class="col-lg-12 col-md-6 text-center">
            <?= $productPost->description; ?>
        </div>
        <div class="col-lg-12 col-md-3 text-center"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <!--<span class="pull-right label label-danger">Last update :<?//= $this->context->dateThai($productPost->updateDateTime, 2, true) ?></span>-->
    </div>
</div>



<?php
$this->registerJsFile($directoryAsset . "/js/plugins/icheck.min.js", ['depends' => [frontend\assets\AppAsset::className()]]);
?>
<script>
    $('input').iCheck();
    $('#lateShippingCheck').on('ifChecked', function (event) {
        var productId = $('input[id=productId]').val();
        var fastId = $('input[id=fastId]').val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= Yii::$app->homeUrl ?>products/get-product-shipping-price/',
            data: {'productId': productId, 'fastId': fastId},
            success: function (data)
            {
                $('#fastId').val(data);
                $('#choose').hide();
                $('#unchoose').show();
            }

        });
    });
    $('#lateShippingCheck').on('ifUnchecked', function (event) {
        var productId = $('input[id=productId]').val();
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= Yii::$app->homeUrl ?>products/get-defult-product-shipping-price/',
            data: {'productId': productId},
            success: function (data)
            {
                $('#fastId').val(data);
                $('#choose').show();
                $('#unchoose').hide();
            }
        });
    });
    $('.incr-btn').on('click', function (e) {
        event.preventDefault();
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var newVal = 1
        if ($button.text() == '+') {
            newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
            $('.incr-btn').popover('hide');
        }
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= Yii::$app->homeUrl ?>cart/change-quantity-item',
            data: {productId: $('#productId').val(), quantity: newVal},
            success: function (data)
            {
                if (data.status)
                {

                    if (data.discountValue != 'null')
                    {
                        $('.discountPrice').html(data.discountValue + ' ฿ extra offyour order');
                    } else
                    {
                        $('.discountPrice').html('&nbsp;Add more than 1 item to your order');
                    }
                    $('#pp' + oldValue).removeClass('priceActive');
                    $('#pp' + newVal).addClass('priceActive');
                    $button.parent().find('input').val(newVal);
                } else
                {
                    if (data.errorCode === 1)
                    {
                        newVal = newVal - 1;
                        $('.incr-btn').popover('show');
                    }
                    $button.parent().find('input').val(newVal);
                }
            }
        });
    });</script>

<div class="col-lg-6 col-md-6" id="productImage">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
    <div class="row">
        <style type="text/css">
            /* #reviews-rate > img{
                width: 50px;
            }*/
            .reviews-rate > img {
                display: initial;
                max-width: 100%;
                height: auto;

            }
            #my-post{
                overflow-y: scroll;
                overflow-x: hidden;
                height:350px;
                max-height:100%;
                color: #635d5d;
            }
        </style>

    </div>

</div>


<!-- Modal -->
<div id="myModal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><div class="views-title" style="font-weight: bold;"></div></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="views-shortDescription" style="font-size: 14px; color: #292c2e;"></div>
                <hr>
                <div class="views-description" style="font-size: 14px; color: #292c2e;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn btn-black btn-xs" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the modal
    function views_click(productPostId, productSuppId, productId) {
        //alert(productPostId);
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "reviews/views-posts",
            data: {productPostId: productPostId, productSuppId: productSuppId, productId: productId},
            success: function (data, status)
            {
                //alert(status);
                if (status == "success") {
                    //var json = data;
                    var rex = /(<([^>]+)>)/ig;
                    //alert(txt.replace(rex, ""));
                    //var Num = 1;
                    console.log(data.title);
                    var title = data.title;
                    var shortDescription = data.shortDescription;
                    var description = data.description;
                    $('.views-title').html('<i class="fa fa-pencil" aria-hidden="true"></i> ' + title);
                    $('.views-shortDescription').html(shortDescription);
                    $('.views-description').html(description);
                }
            }
        });
        $('#myModal').modal('show')
    }


    function ViewsShows() {
        var x = document.getElementById("brand-carousel-reviews").classList;
        //alert(x);
        if (x == 'brand-carousel') {
            $('#brand-carousel-reviews').removeClass("show");
            $('#brand-carousel-reviews').addClass("hide");
            $('.add-new-icon').html('<h3 style="text-decoration: underline;">All Story <i class="fa fa-minus-circle" aria-hidden="true" style="zoom: .7"></i></h3>');
        } else if (x == 'brand-carousel show') {
            $('#brand-carousel-reviews').removeClass("show");
            $('#brand-carousel-reviews').addClass("hide"); //fa fa-minus-circle
            $('.add-new-icon').html('<h3 style="text-decoration: underline;">All Story <i class="fa fa-minus-circle" aria-hidden="true" style="zoom: .7"></i></h3>');
        } else {
            $('#brand-carousel-reviews').removeClass("hide");
            $('#brand-carousel-reviews').addClass("show");
            $('.add-new-icon').html('<h3 style="text-decoration: underline;">All Story <i class="fa fa-plus-circle" aria-hidden="true" style="zoom: .7"></i></h3>');
        }

        //$("#brand-carousel-reviews").removeClass("hide");
    }

</script>