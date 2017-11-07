<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;

$this->title = $section->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #000;color: #ffcc33;">
        <div class="row">
            <div class="col-md-6" style="font-size: 20pt;"> <?= Html::encode($this->title) ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a href="<?= Yii::$app->homeUrl ?>productpost/section/choose-product?sectionId=<?= $section->sectionId ?>" class='btn btn-success'>+ products</a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'Title',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Product::findProductName($model->productId);
                    }
                ],
                ['attribute' => 'Image',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $img = "<img src='" . Yii::$app->homeUrl . ProductSuppliers::productImage($model->productSuppId) . "' stye='heigth:100px;width:100px;'>";

                        return $img;
                    }
                ],
                ['attribute' => 'Show',
                    'format' => 'raw',
                    'value' => function ($model) {

                        $checked = $model->status == 1 ? 'checked' : '';
                        $onclick = "onclick='javascript:showSectionItem(" . $model->sectionItemId . ")'";
                        $checkBox = '<input type="checkbox" id="checkStatus' . $model->productId . '"' . $checked . ' ' . $onclick . '>';
                        return $checkBox;
                    }
                ],
                ['attribute' => 'Action',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $delete = '<a href="javascript:confirmDelItem(' . $model->sectionItemId . ')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete </a>';
                        return $delete;
                    }
                ],
            /* ['class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'template' => '{delete}',
              'buttons' => [
              'delete' => function($model) {

              }
              ]
              ], */
            ],
        ]);
        ?>
    </div>
</div>