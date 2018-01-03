<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\costfit\ProductGroupOptionValue;
use common\models\costfit\Product;
?>
<div class="panel panel-default" >
    <div class="panel-heading" style="background-color: #000;vertical-align: middle;">
        <div class="row">
            <div class="col-md-6">
                <span class="panel-title"><h3 style="color:#ffcc00;vertical-align: middle;">Add / Edit product's options</h3></span>
            </div>
        </div>
    </div>
    <div class="panel-body">

        <table class="table table-light">
            <thead>
            <th><h3>Options</h3></th>
            <th><h3>Values</h3></th>
            </thead>
            <?php
            if (isset($options) && count($options) > 0) {
                foreach ($options as $templateOptionId => $option):
                    ?>
                    <tr>
                        <?php
                        $allOption = ProductGroupOptionValue::optiontValues($templateOptionId, $templateId, $productGroupId);
                        ?><td rowspan="<?= count($allOption) + 1 ?>"style="border: white solid thin;"><h4><?= $option ?></h4></td>
                    </tr>

                    <?php
                    if (isset($allOption) && count($allOption) > 0) {
                        foreach ($allOption as $value):
                            ?>
                            <tr>
                                <td style="border: white solid thin;">
                                    <input type="text" id="optionValue<?= $value->productGroupOptionValueId ?>" name="optionValue[<?= $value->productGroupOptionValueId ?>]" value="<?= $value->value ?>" style="height: 40px;" disabled>
                                    <a class="btn btn-warning"  id="edit<?= $value->productGroupOptionValueId ?>"href="javascript:enableEdit(<?= $value->productGroupOptionValueId ?>);"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-success"  id="save<?= $value->productGroupOptionValueId ?>"href="javascript:saveEdit(<?= $value->productGroupOptionValueId ?>,'<?= $value->value ?>');" style="display: none;"><i class="fa fa-check" aria-hidden="true"></i> Save</a>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <?php
                    $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
                endforeach;
            }
            ?>

        </table>
        <?php
        $form = ActiveForm::begin([
                    'method' => 'POST',
                    'id' => 'newOpiont',
                    'action' => ['product-group/add-new-product'],
        ]);
        ?>
        <div class="col-lg-12 col-md-12" style="border: silver solid thin;padding-bottom: 30px;">
            <h3><i class="fa fa-plus" aria-hidden="true"></i> Add Option value to product group : <?= Product::productGroupName($productGroupId) ?></h3>
            <hr>
            <div class="row">
                <?php
                if (isset($options) && count($options) > 0) {
                    foreach ($options as $templateOptionId => $option):
                        ?>

                        <div class="col-lg-3 col-md-3">
                            <h4><?= $option ?></h4>
                            <input type="text" id="newProduct<?= $templateOptionId ?>" name="newProduct[<?= $templateOptionId ?>]" class=" form-control" style="height: 40px;">
                        </div>

                        <?php
                    endforeach;
                }
                ?>
            </div>  <?= $error ?>
            <br>
            <h4>Or choose exist option values</h4>
            <hr>
            <div class="row">
                <?php
                // throw new \yii\base\Exception(print_r($options, true));
                if (isset($options) && count($options) > 0) {
                    foreach ($options as $templateOptionId => $option):
                        ?>
                        <div class="col-lg-3 col-md-3" style="padding-left:15px;">
                            <h4><?= $option ?></h4>
                            <?php
                            $allOption = ProductGroupOptionValue::optiontValues($templateOptionId, $templateId, $productGroupId);
                            if (isset($allOption) && count($allOption) > 0) {
                                foreach ($allOption as $value):
                                    if ($value->productGroupTemplateOptionId == $templateOptionId) {
                                        ?>
                                        <input type="radio" name="newProduct[<?= $templateOptionId ?>]" style="margin-bottom: 10px;"id="option[<?= $templateOptionId ?>]" onclick="javascript:disableInput(<?= $templateOptionId ?>);" value="<?= $value->value ?>">&nbsp;&nbsp;
                                        <?= $value->value ?>
                                        <br>
                                        <?php
                                    } else {
                                        echo '<div class="col-lg-3 col-md-3" style="padding-left:15px;"> </div>';
                                    }
                                endforeach;
                                ?>

                            <?php }
                            ?></div>
                        <?php
                    endforeach;
                }
                ?>
            </div>
            <br><br>
            <button class="btn btn-success btn-lg" type="submit"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
            <br>
            <input type="hidden" name="productGroupId" value="<?= $productGroupId ?>">
            <input type="hidden" name="templateId" value="<?= $templateId ?>">
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

