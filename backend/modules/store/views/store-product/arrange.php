<?php
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
<input type="hidden" name="storeProductId" value="<?= $model->storeProductId ?>">
<div class="panel-body">
    <?php
    if (isset($model)):
        ?>

        <div class="col-lg-12">
            <h4>สินค้า : <?= $model->title ?></h4>
            <table class="table">
                <tbody>
                    <tr>
                        <th style="vertical-align: middle;">Slot : </th>
                        <th><?= \yii\helpers\Html::textInput('slot', NULL, ['class' => 'input-lg slot', 'autofocus' => 'autofocus']); ?> * scan slot <?= isset($ms) && $ms != '' ? '<code>' . $ms . '</code>' : '' ?></th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle;">Quantity : </th>

                        <th><?= \yii\helpers\Html::textInput('quantity', NULL, ['class' => 'input-lg quantity']); ?> * จำนวนทั้งหมดในรายการนี้ <?= $model->importQuantity ?> ชิ้น จัดเรียงแล้ว 50 ชิ้น ยังไม่จัดเรียง 50 ชิ้น</th>
                    </tr>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-left">
                            <?= \yii\helpers\Html::submitButton("จัดเรียง", ['class' => 'btn btn-success btn-lg']) ?></td>
                    </tr>
                    <?= $this->registerJS("
                            $('.slot').on('keypress',function(event){
                                if(event.which == 13 || event.keyCode == 13)
                                {
                                    $('.quantity').focus();
                                    return false; // returning false will prevent the event from bubbling up.
                                }
                            });
                ") ?>
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
</div>
<?php yii\bootstrap\ActiveForm::end(); ?>
