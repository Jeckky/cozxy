<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Create Price</div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ],
                    ]); ?>
                    <?= $form->field($productPriceCurrencyModel, 'currencyId')->dropDownList($currencyModel->currencyCodeArray) ?>
                    <?= $form->field($productPriceCurrencyModel, 'price')->textInput() ?>

                    <?= Html::submitButton('Create Price', ['class' => 'btn btn-success btn-block btn-lg']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Create Price</div>
                <div class="panel-body">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProdiver,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'productPriceCurrencyId',
                            'status',
                            [
                                'attribute'=>'currencyId',
                                'value'=>function($model) {
                                    return $model->currency->code;
                                }
                            ],
                            'price',
                            // 'productId',
                            'createDateTime',

//                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
