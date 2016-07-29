<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use common\models\areawow\Order; 
use common\models\areawow\Product; 
use common\models\areawow\ProductGroup; 
use common\models\areawow\Brand; 
use common\models\areawow\Category; 

/* @var $this yii\web\View */
/* @var $model common\models\costfit\OrderItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-item-form">

    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
    'fieldConfig' => [
    'template' => '{label}<div class="col-sm-9">{input}</div>',
    'labelOptions'=>[
    'class'=>'col-sm-3 control-label'
    ]
    ]
    ]); ?>

    <div class="panel-heading">
        <span class="panel-title"><?=$title?></span>
    </div>

    <div class="panel-body">
        		<?= $form->errorSummary($model)?>

		<?= $form->field($model, 'orderId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Order::find()->all(), 'orderId', 'title'), ['prompt' => '-- Select Order --']) ?>

		<?= $form->field($model, 'productId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Product::find()->all(), 'productId', 'title'), ['prompt' => '-- Select Product --']) ?>

		<?= $form->field($model, 'productGroupId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(ProductGroup::find()->all(), 'productGroupId', 'title'), ['prompt' => '-- Select ProductGroup --']) ?>

		<?= $form->field($model, 'brandId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Brand::find()->all(), 'brandId', 'title'), ['prompt' => '-- Select Brand --']) ?>

		<?= $form->field($model, 'categoryId',['options'=>['class'=>'row form-group']])->dropDownList(ArrayHelper::map(Category::find()->all(), 'categoryId', 'title'), ['prompt' => '-- Select Category --']) ?>

		<?= $form->field($model, 'quantity',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 15]) ?>

		<?= $form->field($model, 'price',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 15]) ?>

		<?= $form->field($model, 'total',['options'=>['class'=>'row form-group']])->textInput(['maxlength' => 15]) ?>

                <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
