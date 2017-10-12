<?php

use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use kartik\editable\Editable;
use common\models\costfit\ProductImage;
?>
<h3>Product Master Images</h3>
<?php
$images = ProductImage::productMasterImage($id);
?>
<table class="table table-striped table-bordered text-center">
    <thead class="text-center">
        <tr>
            <th><center>#</center></th>
<th style="width: 40%;"><center>Images</center></th>
<th><center>Ordering</center></th>
<th><center>status</center></th>
<th><center>Action</center></th>
</tr>
</thead>
<tbody>
    <?php
    $i = 1;
    if (isset($images) && count($images) > 0 && $images != 0) {
        $total = count($images);
        foreach ($images as $image):
            ?>
            <tr>
                <td style="vertical-align: middle;">
                    <?= $i ?>
                </td>
                <td style="vertical-align: middle;">
                    <?= \yii\helpers\Html::a(\yii\helpers\Html::img(Yii::$app->homeUrl . $image->imageThumbnail1, ['style' => (Yii::$app->controller->action->id == "create") ? 'width:100px' : 'width:200px']), Yii::$app->homeUrl . $image->image, ['target' => "_blank", 'data-pjax' => 0]); ?>
                </td>
                <td style="vertical-align: middle;">
                    <a href="javascript:orderingImageMaster(<?= $image->productImageId ?>,<?= $total ?>,0)" class="btn btn-warning" style="font-size: 14pt;">-</a>&nbsp;&nbsp;&nbsp;
                    <span id="ordering<?= $image->productImageId ?>" style="font-size: 14pt;"> <?= $image->ordering ?> </span>
                    &nbsp;&nbsp;&nbsp;
                    <a href="javascript:orderingImageMaster(<?= $image->productImageId ?>,<?= $total ?>,1)" class="btn btn-success"style="font-size: 14pt;">+</a>
                </td>
                <td style="vertical-align: middle;">
                    <input type="checkbox" id="imgStatus<?= $image->productImageId ?>" <?= $image->status == 1 ? 'checked' : '' ?> onclick="javascript:changeImageMasterStatus(<?= $image->productImageId ?>)">&nbsp;&nbsp;&nbsp;ใช้งาน
                </td>
                <td style="vertical-align: middle;">
                    <a href="delete-product-image?id=<?= $image->productImageId ?>&&step=<?= $_GET["step"] ?>&&productGroupTemplateId=<?= $_GET["productGroupTemplateId"] ?>&&productGroupId=<?= $_GET["productGroupId"] ?>&&action=update&&productSuppId=<?= $id ?>" class="btn btn-danger" id="deleteImg<?= $image->productImageId ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                        <i class="glyphicon glyphicon-trash"></i> ลบ
                    </a>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
    }
    ?>
</tbody>
</table>
