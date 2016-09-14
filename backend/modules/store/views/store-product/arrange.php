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
<div class="panel-heading">
    <span class="panel-title">ค้นหาสินค้าเพื่อจัดเรียง</span>
</div>

<div class="panel-body">
    <?php if (isset($model)): ?>
        <div class="row">
            <!--            <div class="col-lg-2">
                            <img src="<?= Yii::$app->homeUrl . $model->productImages[0]->image; ?>" style="width: 100%">
                        </div>-->
            <div class="col-lg-12">
    <!--                <h4><?= $model->code; ?></h4>
                <h4><?= $model->title; ?></h4>-->
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Slot : </th>
                            <td><?= \yii\helpers\Html::textInput('slot', NULL, ['class' => 'input-lg slot', 'autofocus' => 'autofocus']); ?></td>
                        </tr>
                        <tr>
                            <th>Quantity : </th>
                            <td><?= \yii\helpers\Html::textInput('quantity', NULL, ['class' => 'input-lg quantity']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <?= \yii\helpers\Html::a("กลับ", ['arrange'], ['class' => 'btn btn-info btn-lg ']) ?>
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
            <!--            <div class="col-lg-2">

                        </div>-->
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <h2>ไม่พบรายการรอจัดเรียง</h2>
                <?= $this->registerJS("setTimeout(function () {
                    window.location.href = '" . Yii::$app->homeUrl . "store/store-product/arrange" . "'; //will redirect to your blog page (an ex: blog.html)
                 }, 1500); //will call the function afte

                ") ?>
                <?//= \yii\helpers\Html::a("กลับ", ['arrange', 'storeProductGroupId' => $_GET["storeProductGroupId"]], ['class' => 'btn btn-info']) ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php yii\bootstrap\ActiveForm::end(); ?>
