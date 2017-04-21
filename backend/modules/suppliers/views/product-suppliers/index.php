<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/*
  $items = array(
  array('id' => 1, 'parent_id' => 0, 'name' => 'Category A'),
  array('id' => 2, 'parent_id' => 0, 'name' => 'Category B'),
  array('id' => 3, 'parent_id' => 0, 'name' => 'Category C'),
  array('id' => 4, 'parent_id' => 0, 'name' => 'Category D'),
  array('id' => 5, 'parent_id' => 0, 'name' => 'Category E'),
  array('id' => 6, 'parent_id' => 2, 'name' => 'Subcategory F'),
  array('id' => 7, 'parent_id' => 2, 'name' => 'Subcategory G'),
  array('id' => 8, 'parent_id' => 3, 'name' => 'Subcategory H'),
  array('id' => 9, 'parent_id' => 4, 'name' => 'Subcategory I'),
  array('id' => 10, 'parent_id' => 9, 'name' => 'Subcategory J'),
  );

  function buildTree($items) {

  $childs = array();

  foreach ($items as &$item)
  $childs[$item['parent_id']][] = &$item;
  unset($item);

  foreach ($items as &$item)
  if (isset($childs[$item['id']]))
  $item['childs'] = $childs[$item['id']];

  return $childs[0];
  }

  $tree = buildTree($items);
  echo '<pre>';
  print_r($tree);
  foreach ($tree as $key => $value) {
  echo $key . '::' . $value['name'] . '<br>';
  if (isset($value['childs']) && count($value['childs']) > 0) {
  foreach ($value['childs'] as $key => $item) {
  echo '&nbsp;&nbsp; - ' . $item['name'] . '<br>';
  if (isset($item['childs']) && count($item['childs']) > 0) {
  foreach ($item['childs'] as $key => $items) {
  echo '&nbsp;&nbsp;&nbsp; - ' . $items['name'] . '<br>';
  if (isset($items['childs']) && count($items['childs']) > 0) {
  foreach ($items['childs'] as $key => $itemss) {
  echo '&nbsp;&nbsp;&nbsp;&nbsp; - ' . $itemss['name'] . '<br>';
  }
  }
  }
  }
  }
  }
  } */

//exit();
$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
//echo Yii::$app->user->identity->type;
if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
    header("location: /auth");
    exit(0);
}
?>
<div class="product-suppliers-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Suppliers', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productId',
                    //'userId',
                    //'productGroupId',
                    /* [
                      'attribute' => 'brand',
                      'value' => function($model) {
                      return isset($model->brand) ? $model->brand->title : NULL;
                      }
                      ],
                      [
                      'attribute' => 'category',
                      'value' => function($model) {
                      return isset($model->category) ? $model->category->title : NULL;
                      }
                      ],
                      //'isbn',
                      ['attribute' => 'isbn',
                      'label' => 'isbn',
                      //'contentOptions' => ['style' => 'width:70px;  min-width:70px;  '],
                      ],
                      'code',
                      //'title', */
                    [
                        'attribute' => 'isbn & code',
                        'format' => 'html',
                        'value' => function($model) {
                            return '<div class="col-sm-12"><strong>isbn : </strong>' . trim($model->isbn) . '</div>'
                            . '<div class="col-sm-12"><strong>code : </strong> ' . $model->code . '</div>'
                            ;
                        }
                    ],
                    [
                        'attribute' => 'รายละเอียดสินค้า',
                        'format' => 'raw',
                        'value' => function($model) {
                            $title = $model->title;
                            $category = isset($model->category) ? \common\models\costfit\Category::getRootText($model->categoryId, TRUE) : NULL;
                            $brand = isset($model->brand) ? $model->brand->title : NULL;
                            $url = isset($model->url) ? Html::a('url brand', $model->url, ['target' => '_blank', 'data-pjax' => "0"]) : 'ไม่ระบุ';

                            return '<strong>Title : </strong>' . $title . '<br>'
                            . '<strong>Category : </strong> ' . $category . '<br>'
                            . '<strong>Brand : </strong>' . $brand . '<br>'
                            . '<strong>Url : </strong>' . $url
                            ;
                        }
                    ],
                    // 'optionName',
                    // 'shortDescription:ntext',
                    // 'description:ntext',
                    // 'specification:ntext',
                    // 'width',
                    // 'height',
                    // 'depth',
                    // 'weight',
                    'quantity',
                    [
                        'attribute' => 'คงเหลือ',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a($model->result . ' ชิ้น(<i class="fa fa-plus-circle" aria-hidden="true" class="success"></i>เพิ่มจำนวนสินค้า)', Yii::$app->homeUrl . "suppliers/product-total-suppliers/create?productSuppId=" . $model->productSuppId . '&total=addup', [
                                'title' => Yii::t('app', 'เพิ่มจำนวนสินค้า'), 'class' => 'text-center']);
                        }
                    ],
                    [
                        'attribute' => 'ราคาล่าสุด',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->priceSuppliers;
                        }
                    ],
                    [
                        'attribute' => 'ราคา',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-plus-circle" aria-hidden="true" class="success"></i>เพิ่มราคาใหม่', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                                'title' => Yii::t('app', 'เพิ่มราคาใหม่'), 'class' => 'text-center']);
                        }
                    ],
                    //'approve',
                    [
                        'attribute' => 'สถานะอนุมัติ',
                        'format' => 'html',
                        'value' => function($model) {
                            if ($model->approve == 'old') {
                                $txt = '<span class="text-warning">รออนุมัติ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            } else if ($model->approve == 'approve') {
                                $txt = '<span class="text-success">อนุมัติแล้ว</span>';
                            } else if ($model->approve == 'new') {
                                $txt = '<span class="text-warning">รออนุมัติ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            } else {
                                $txt = '<span class="text-danger">แจ้งเจ้าหน้าที่ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            }
                            return $txt;
                        }
                    ],
                    [
                        'attribute' => 'Duplicates',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-plus-circle" aria-hidden="true" class="success"></i>duplicate', Yii::$app->homeUrl . "suppliers/product-suppliers/duplicate-product?productSuppId=" . $model->productSuppId, [
                                'title' => Yii::t('app', 'duplicate product'), 'class' => 'text-left']);
                        }
                    ],
                    // 'unit',
                    // 'smallUnit',
                    // 'tags',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    //'image',
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function($model) {
                            $productImageSupplers = common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $model->productSuppId)->orderBy('productImageId')->limit(1)->one();
                            if (isset($productImageSupplers)) {
                                //echo $productImageSupplers->imageThumbnail2;
                                return Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรูปภาพใหม่ <i class="fa fa-picture-o"></i>', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                    'title' => Yii::t('app', 'image'), 'class' => 'text-center']) .
                                Html::img(Yii::$app->homeUrl . $productImageSupplers->imageThumbnail2, ['style' => 'width:137px;height:130px', 'class' => 'img-responsive']);
                            } else {
                                return Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรูปภาพใหม่ <i class="fa fa-picture-o"></i>', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                    'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                            }
                        },
                        'contentOptions' => ['style' => 'width:100px;  min-width:100px;  '],
                    ],
                    /*
                      [
                      'attribute' => 'Smart',
                      'format' => 'html',
                      'value' => function($model) {
                      return Html::a('<i class="fa fa-btc"></i> เพิ่มราคาขายและราคาค่าจัดส่ง', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                      'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                      }
                      ], */
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {post}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                            },
                            'post' => function($url, $model) {
                                return Html::a('<br><u>Review</u>', ['/suppliers/product-post', 'productSuppId' => $model->productSuppId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'), 'target' => '_blank', 'data-pjax' => 0]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
