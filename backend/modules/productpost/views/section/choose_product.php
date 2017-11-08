<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use common\models\costfit\Product;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\SectionItem;

$this->title = "Select products";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #000;color: #ffcc33;">
        <div class="row">
            <div class="col-md-6" style="font-size: 20pt;"> <?= Html::encode($this->title) ?> to " <?= $section->title ?> "</div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a class="btn btn-warning"href="<?= Yii::$app->homeUrl ?>productpost/section/add-product?id=<?= $section->sectionId ?>"> <<< Back to section</a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?= $this->render('_search', ['sectionId' => $section->sectionId]) ?>
        <div class="col-lg-12 col-md-12 text-right" id="showSuccess" style="color: #0000ff;font-size: 16pt;"></div>
        <div class="col-lg-12 col-md-12 text-right" id="showNotSuccess" style="color: #ff3333;font-size: 16pt;"></div>
        <?php
        Pjax::begin(['id' => 'employee-grid-view']);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $varibleProduct,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'Title',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->title;
                    }
                ],
                ['attribute' => 'Image',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $img = "<img src='" . Yii::$app->homeUrl . ProductSuppliers::productImage($model->productSuppId) . "' stye='heigth:100px;width:100px;'>";

                        return $img;
                    }
                ],
                ['attribute' => 'Select',
                    'format' => 'raw',
                    'value' => function ($model) use($section) {
                        //throw new \yii\base\Exception(print_r($section, true));
                        $check = SectionItem::checkItemInSection($section->sectionId, $model->productId, $model->productSuppId);
                        $checked = $check == 1 ? 'checked' : '';
                        $onclick = "onclick='javascript:selectProduct(" . $section->sectionId . "," . $model->productId . "," . $model->productSuppId . ")'";
                        $checkBox = '<input type="checkbox" id="checkStatus' . $model->productId . '"' . $checked . ' ' . $onclick . '>';
                        return $checkBox;
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
        <?php Pjax::end(); ?>
    </div>
</div>