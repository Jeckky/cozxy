<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductGroup */

$this->params['breadcrumbs'][] = ['label' => 'Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-group-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Crop Image</span>
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <div class="row">
                <div class="col-md-9">
                    <?=Html::img(Url::home().$productImage->image, ['id'=>'image', 'class'=>'img-responsive'])?>
                </div>
                <div class="col-md-3">
                    <div class="preview"></div>
                    <button class="btn btn-primary btn-block" id="saveThumbnail">Save Thumbnail</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
echo $this->registerJs('
var $previews = $(".preview");
var imageData;

$(\'#image\').cropper({
  aspectRatio: 1 / 1,
  ready: function (e) {
            var $clone = $(this).clone().removeClass(\'cropper-hidden\');

            $clone.css({
              display: \'block\',
              width: \'100%\',
              minWidth: 0,
              minHeight: 0,
              maxWidth: \'none\',
              maxHeight: \'none\'
            });

            $previews.css({
              width: \'100%\',
              overflow: \'hidden\'
            }).html($clone);
          },
  crop: function(e) {
    // Output the result data for cropping image.
     imageData = $(this).cropper(\'getImageData\');
            var previewAspectRatio = e.width / e.height;

            $previews.each(function () {
              var $preview = $(this);
              var previewWidth = $preview.width();
              var previewHeight = previewWidth / previewAspectRatio;
              var imageScaledRatio = e.width / previewWidth;

              $preview.height(previewHeight).find(\'img\').css({
                width: imageData.naturalWidth / imageScaledRatio,
                height: imageData.naturalHeight / imageScaledRatio,
                marginLeft: -e.x / imageScaledRatio,
                marginTop: -e.y / imageScaledRatio
              });
            });
          }
});

$("#saveThumbnail").on("click", function(){
   $("image").cropper("getImageData").toBlob(function(blob){
        var formData = new FormData();
   }); 
});
');
?>