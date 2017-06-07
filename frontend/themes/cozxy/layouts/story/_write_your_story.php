<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
?>

<style>
    .write-story-banner {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .write-story-banner img {
        position: absolute;
        left: -100%;
        right: -100%;
        top: -100%;
        bottom: -100%;
        margin: auto;
        height: auto;
        width: auto;
    }
</style>
<?php
$form = ActiveForm::begin([
    'id' => 'story',
    'method' => 'POST',
    'action' => Yii::$app->homeUrl . 'story/write-story',
    'options' => ['enctype' => 'multipart/form-data']
]);
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-white">
            <h1 class="page-header">
                <p style="margin: 0px;" class="size20 fc-g999">   <?= $productSupplier->title ?> </p>
                <?//= $productSupplier->title ?>
            </h1>
            <div class="write-story-banner">
                <?= Html::img(Url::home() . $image, ['class' => 'img-responsive']) ?>
            </div>
            <div class="size12 size10-xs">&nbsp;</div>

            <div class="form-group">
                <?php
                /*  echo $form->field($model, 'productSelfId')->widget(kartik\select2\Select2::classname(), [
                  //'options' => ['id' => 'address-countryid'],
                  'data' => $shelf,
                  'pluginOptions' => [
                  'placeholder' => 'Select...',
                  'loadingText' => 'Loading Shelf ...',
                  ],
                  'options' => ['placeholder' => 'Select Shelf ...'],
                  ])->label('Product Self'); */
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <?php echo $form->field($model, 'title')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Title'])->label(FALSE); ?>
            </div>
            <div class="form-group">
                <?=
                $form->field($model, 'description', ['options' => ['class' => '']])->widget(\yii\redactor\widgets\Redactor::className([
                    'settings' => [
                        'uploadDir' => ['@webroot/images/story/' . Yii::$app->user->id],
                        'uploadUrl' => ['@web/images/story/' . Yii::$app->user->id],
                    ]
                ]), [
                    'clientOptions' => [
                        'minHeight' => 350,
                        'lang' => 'en',
                        'clipboardUpload' => true,
                        'plugins' => ['fullscreen', 'fontfamily', 'fontcolor', 'fontsize', 'imagemanager',],
                        'buttons' => [
                            'formatting', '|', 'bold', 'italic', 'underline', 'deleted', '|',
                            'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                            'image', 'file', 'table', 'link', '|',
                            'alignment', '|', 'horizontalrule',
                            '|', '|', 'alignleft', 'aligncenter', 'alignright', 'justify'
                        ],
                    ]
                ], ['style' => 'height:1000px;'])
                ?>
            </div>
            <div class="size12 size10-xs">&nbsp;</div>
            <div class="panel panel-default">
                <div class="panel-heading">Compare Price</div>
                <div class="panel-body login-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Shop Name</label>
                                <!--<input type="text" name="shopName" class="fullwidth" placeholder="Shop Name" required>-->
                                <?php echo $form->field($model, 'shopName')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Shop Name'])->label(FALSE); ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <!--<input type="text" name="price" class="fullwidth" placeholder="Price" required>-->
                                        <?php echo $form->field($model, 'price')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Price'])->label(FALSE); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="margin-top: 7px;">
                                        <label for="exampleInputEmail1">Country</label>
                                        <?php
                                        echo $form->field($model, 'country')->widget(kartik\select2\Select2::classname(), [
                                            //'options' => ['id' => 'address-countryid'],
                                            'data' => $country,
                                            'pluginOptions' => [
                                                'placeholder' => 'Select...',
                                                'loadingText' => 'Loading Country ...',
                                            ],
                                            'options' => ['placeholder' => 'Select Country ...'],
                                        ])->label(FALSE);
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"  style="margin-top: 7px;">
                                        <label for="exampleInputEmail1">Currency</label>
                                        <?php
                                        echo $form->field($model, 'currency')->widget(kartik\select2\Select2::classname(), [
                                            //'options' => ['id' => 'address-countryid'],
                                            'data' => $currency,
                                            'pluginOptions' => [
                                                'placeholder' => 'Select...',
                                                'loadingText' => 'Select Currency ...',
                                            ],
                                            'options' => ['placeholder' => 'Select Currency ...'],
                                        ])->label(FALSE);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label for="exampleInputEmail1">Picture</label>
                                <input type="file" name="story[image]" class="fullwidth" placeholder="Shop Name" required>
                            </div>-->
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Location (Lat,Long)</label>
                                        <input type="text" name="firstname" class="fullwidth" placeholder="Location (Lat,Long)">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="map" style="height:200px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <input type="checkbox" name="isPublic" checked="true"> Make public
                </div>
                <div class="col-md-6 text-right">
                    <input type="hidden" name="productSuppId" value="<?= $productSupplier->productSuppId ?>">
                    <input type="hidden" name="productSuppName" value="<?= $productSupplier->title ?>">
                    <button class="btn-yellow" typ="submit">Save Story</button>
                </div>
            </div>
            <div class="size12 size10-xs">&nbsp;</div>
        </div>

    </div>

    <div class="size12 size10-xs">&nbsp;</div>
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerCss('
#map {
            height: 300px;
        }
');

$this->registerJs('
        var map;
        function initMap() {
            var myLatLng = { lat: -25.363, lng: 131.044 };
            map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 16
            });

            var marker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: "Hello World!"
            });
        }

function changeMap(lats, lngs) {

    var myLatLng = {lat: Number(lats), lng: Number(lngs)};// get ค่ามาจาก address แต่เป็น String ต้องเปลียนให้เป็น Number
    console.log(myLatLng);
    //document.getElementById("map").innerHTML = "Paragraph changed!";
    //$(".cart-detail").find("#map").html("xxxxxx");
    map = new google.maps.Map(document.getElementById("map"), {
        center: myLatLng,
        zoom: 11,
        mapTypeId: "hybrid"
    });

    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: "Hello World!"
    });
}
', \yii\web\View::POS_HEAD);



$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]);
?>