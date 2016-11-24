<?php

use common\models\costfit\StoreProductArrange;

$form = yii\bootstrap\ActiveForm::begin([
            'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div>',
                'labelOptions' => [
                    'class' => 'col-sm-3 control-label'
                ]
            ]
        ]);
?>
<div class="panel-heading" style="background-color: #ccffcc;vertical-align: middle;">
    <span class="panel-title"><h3>จัดเรียงสินค้า</h3></span>
</div>
<input type="hidden" name="isbn" value="<?= $isbn ?>">
<input type="hidden" name="arrange" value="arrange">
<!--<input type="hidden" name="storeProductId" value="<?//= $model->storeProductId ?>">-->
<input type="hidden" name="storeProductGroupId" value="<?= $chooseStoreProductGroup ?>">
<?php foreach ($allProducts as $product):
    ?>
    <input type="hidden" name="allProduct[]" value="<?= $product ?>">
<?php endforeach;
?>
<div class="panel-body">
    <?php
    if (isset($model) && !empty($model)):
        // throw new \yii\base\Exception(print_r($model, true));
        ?>

        <div class="col-lg-12">
            <h4>สินค้า : <?= $isbn ?></h4>
            <table class="table">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;">Slot : </th>
                        <th><?=
                            \yii\helpers\Html::textInput('slot', isset($aSlot) ? $aSlot : NULL, ['class' => 'input-lg slot', 'autofocus' => 'autofocus'
                            ]);
                            ?> * scan slot <?= isset($ms) && $ms != '' ? '<code>' . $ms . '</code>' : '' ?></th>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($model as $po):
                        ?>
                        <tr>
                            <th style="vertical-align: middle;">Quantity : </th>
                            <th><?= \yii\helpers\Html::textInput('quantity[' . $po->storeProductGroupId . ']', NULL, ['class' => 'input-lg quantity' . $i]); ?> * <?= \common\models\costfit\StoreProductGroup::poNo($po->storeProductGroupId) ?> จำนวน <?= $po->importQuantity ?>
                                ชิ้น จัดเรียงแล้ว <code><?= StoreProductArrange::countProductArrange($po->productId, $po->storeProductId) ?></code> ชิ้น
                                ยังไม่จัดเรียง <code><?= $po->importQuantity - StoreProductArrange::countProductArrange($po->productId, $po->storeProductId) ?></code> ชิ้น

                            </th>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    <?= $this->registerJS("
                            $('.slot').on('keypress',function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                    $('.quantity0').focus();
                                    return false; // returning false will prevent the event from bubbling up.
                                }
                            });
                ") ?>
                    <?php
                    $i = 0;
                    $nPo = count($model);
                    foreach ($model as $po):
                        $b = $i + 1;
                        ?>
                        <?= $this->registerJS("
                            $('.quantity$i').on('keypress',function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                if($b!=$nPo){
                                    $('.quantity$b').focus();
                                    return false; // returning false will prevent the event from bubbling up.
                                    }
                                }
                            });
                ") ?>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <?= \yii\helpers\Html::submitButton("จัดเรียง", ['class' => 'btn btn-success btn-lg']) ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12">
            <h2>ไม่พบรายการรอจัดเรียง</h2>
            <?= $this->registerJS("setTimeout(function () {
                    window.location.href = '" . Yii::$app->homeUrl . "store/store-product/arrange" . "'; //will redirect to your blog page (an ex: blog.html)
                 }, 1500); //will call the function afte

                ") ?></div>
    </div>
<?php endif; ?>
<?php yii\bootstrap\ActiveForm::end(); ?>
