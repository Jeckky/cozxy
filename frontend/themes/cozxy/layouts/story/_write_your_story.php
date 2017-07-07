<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

$this->title = 'Write your story : ' . $productSupplier->title;
$this->params['breadcrumbs'][] = $this->title;
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
if (Yii::$app->controller->action->id == 'update-stories') {
    $form = ActiveForm::begin([
        'id' => 'story',
        'method' => 'POST',
        'options' => ['enctype' => 'multipart/form-data']
    ]);
} else {
    $form = ActiveForm::begin([
        'id' => 'story',
        'method' => 'POST',
        'action' => Yii::$app->homeUrl . 'story/write-story',
        'options' => ['enctype' => 'multipart/form-data']
    ]);
}
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-white">
            <h1 class="page-header">
                <p style="margin: 0px;" class="size20 fc-g999">   <?= $productSupplier->title ?> </p>
            </h1>
            <div class="write-story-banner">
                <?= Html::img(Yii::$app->homeUrl . $image, ['class' => 'img-responsive', 'style' => '100%']) ?>
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
            <div class="form-group login-box">
                <label for="exampleInputEmail1">Title</label>
                <?php echo $form->field($model, 'title')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Title'])->label(FALSE); ?>
            </div>
            <div class="form-group login-box">
                <label for="exampleInputEmail1">Short Description</label>
                <?php
                echo $form->field($model, 'shortDescription')->textarea(['rows' => '6', 'maxlength' => 140])->hint('Max 140 characters.')->label(FALSE);
                ?>
                <div id="productpost-shortdescription-text">
                    <blockquote id="result"  style="font-size: 14px;">
                        <!--Words: <span id="wordCount">0</span><br/>-->
                        Total Characters(including trails): <span id="totalChars">0</span><br/>
                        Characters (excluding trails): <span id="charCount">0</span><br/>
                        Characters (excluding all spaces): <span id="charCountNoSpace">0</span>

                        <footer>Max 140 characters. <cite title="Source Title">in story</cite></footer>
                    </blockquote>

                </div>
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
                        'plugins' => ['fullscreen', 'fontfamily', 'fontcolor', 'fontsize', 'imagemanager',
                            'clips',
                            'counter',
                            'definedlinks',
                            'filemanager',
                            'limiter',
                            'table',
                            'textdirection',
                            'textexpander',
                            'video'],
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
            <?php if (Yii::$app->controller->action->id != 'update-stories') { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Compare Price</div>
                    <div class="panel-body login-box">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Shop Name</label>
                                    <?php echo $form->field($modelComparePrice, 'shopName')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Shop Name'])->label(FALSE); ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <?php echo $form->field($modelComparePrice, 'price')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Price'])->label(FALSE); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 7px;">
                                            <label for="exampleInputEmail1">Country</label>
                                            <?php
                                            echo $form->field($modelComparePrice, 'country')->widget(kartik\select2\Select2::classname(), [
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
                                    <div class="col-md-6">
                                        <div class="form-group"  style="margin-top: 7px;">
                                            <label for="exampleInputEmail1">Currency</label>
                                            <?php
                                            echo $form->field($modelComparePrice, 'currency')->widget(kartik\select2\Select2::classname(), [
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
                            <div class="col-md-6"><label for="exampleInputEmail1">Location (Lat,Long)</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group compareprice-latitude">
                                            <?php echo $form->field($modelComparePrice, 'latitude')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Location (latitude)', 'onchange' => 'changeMap(this.value,\'\')'])->label(FALSE); ?>
                                            <input type="hidden" id="latitude" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group compareprice-longitude">
                                            <?php echo $form->field($modelComparePrice, 'longitude')->textInput([ 'class' => 'fullwidth', 'placeholder' => 'Location (longitude)', 'onchange' => 'changeMap(\'\',this.value)'])->label(FALSE); ?>
                                            <input type="hidden" id="longitude" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <div id="productpostcompareprice-longitude-label" style="padding: 5px; color: red;"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="map" style="height:200px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if ($model->isPublic === 1) {
                        echo '<input type="checkbox" name="isPublic" id="isPublic" checked="true"> Make public';
                    } else if ($model->isPublic === 0) {
                        echo '<input type="checkbox" name="isPublic" id="isPublic" > Make public';
                    } else {
                        echo '<input type="checkbox" name="isPublic" id="isPublic" checked="true"> Make public';
                    }
                    ?>
                </div>
                <div class="col-md-6 text-right">
                    <input type="hidden" name="productSuppId" value="<?= $productSupplier->productSuppId ?>">
                    <input type="hidden" name="productSuppName" value="<?= $productSupplier->title ?>">
                    <button class="btn-yellow save-story" typ="submit">Save Story</button>
                </div>
            </div>
            <div class="size12 size10-xs">&nbsp;</div>
        </div>

    </div>

    <div class="size12 size10-xs">&nbsp;</div>
</div>
<!--
<div class="texCount"></div>
<textarea class="comment"></textarea>-->
<script>
    /* $(document).ready(function () {
     var text_Max = 200;
     $('.texCount').html(text_Max + 'Words');

     $('.comment').keyup(function () {
     var text_Length = $('.comment').val().length;
     var text_Remain = text_Max - text_Length;
     $('.texCount').html(text_Remain + 'Words');

     $('.comment').keydown(function (e) {
     if (text_Remain == 0) {
     e.preventDefault();
     }
     });
     });
     });*/
</script>

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

        if(lats != ""){
            $("input:hidden:eq(0)", ".compareprice-latitude").val(lats);
        }

        if(lngs != ""){
            $("input:hidden:eq(0)", ".compareprice-longitude").val(lngs);
        }

        var getLats =  $("#latitude").val();
        var getLngs = $("#longitude").val();
        if(getLats != ""  && getLngs == ""){
            //alert("Please fill in your location longitude.");
            $("#productpostcompareprice-longitude-label").html("Please fill in your location longitude");
            $("#productpostcompareprice-longitude").focus();
            return false;
        }

        if(getLats != ""  && getLngs != ""){
            $("#productpostcompareprice-longitude-label").html("");
        }

        var myLatLng = {lat: Number(getLats), lng: Number(getLngs)}; // get ค่ามาจาก address แต่เป็น String ต้องเปลียนให้เป็น Number
        //console.log(myLatLng);
        //console.log({lat: Number(lats), lng: Number(lngs)});
        //document.getElementById("map").innerHTML = "Paragraph changed!";
        //$(".cart-detail").find("#map").html("xxxxxx");
        map = new google.maps.Map(document.getElementById("map"), {
        center: myLatLng,
         zoom:16,
         //mapTypeId: "terrain"
        });

        var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: "Hello World!"
    });
} ', \yii\web\View::POS_HEAD);

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&callback=initMap', ['depends' => ['yii\web\YiiAsset']]);
?>


