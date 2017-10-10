<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\ProductSuppliers */

$this->title = 'Price : '. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-suppliers-create">

    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'form-horizontal',
                    'enctype' => 'multipart/form-data'
                ],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 control-label'
                    ]
                ]
            ]); ?>

            <?= $form->field($model->productPriceSuppliers, 'price')->textInput(['disabled'=>true, 'name'=>'currentPrice'])->label('Curretn Price') ?>
            <?= $form->field($productPriceSuppliers, 'price')->textInput(['value'=>0])->label('New Price') ?>
            <div class="col-md-9 col-md-offset-3">
                <?=Html::submitButton('Change Price', ['class'=>'btn btn-primary btn-block btn-lg'])?>
            </div>

            <?php ActiveForm::end();?>
        </div>
    </div>

</div>
