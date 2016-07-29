<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\grid\GridView;
use kartik\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--<link href="http://demos.krajee.com/assets/prod/all-krajee.css" rel="stylesheet">

<link href="http://demos.krajee.com/assets/adee4ef/css/kv-grid-expand.min.css" rel="stylesheet">
<link href="http://demos.krajee.com/assets/adee4ef/css/kv-grid.min.css" rel="stylesheet">
<link href="http://demos.krajee.com/assets/adee4ef/css/kv-grid-action.min.css" rel="stylesheet">
<link href="http://demos.krajee.com/assets/9b661368/css/activeform.min.css" rel="stylesheet">
-->

<style>
    .table-light{
        font-size: 14px;
    }

</style>
<?php
//foreach ($model_list as $key => $value) {
//  echo $value->orderId . '<br>';
//}
?>

<?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        // 'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'orderNo',
    //'pageSummary' => 'Page Total',
    //'vAlign' => 'middle',
    //'headerOptions' => ['class' => 'kv-sticky-column'],
    // 'contentOptions' => ['class' => 'kv-sticky-column'],
    // 'editableOptions' => ['header' => 'Name', 'size' => 'md']
    ],
    [
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'status',
    // 'vAlign' => 'middle',
    ],
    'createDateTime',
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => true,
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return '#';
        },
        'viewOptions' => ['title' => 'viewMsg', 'data-toggle' => 'tooltip'], // $viewMsg
        'updateOptions' => ['title' => 'updateMsg', 'data-toggle' => 'tooltip'], // $updateMsg
        'deleteOptions' => ['title' => 'deleteMsg', 'data-toggle' => 'tooltip'], // $deleteMsg,
    ],
    ['class' => 'kartik\grid\CheckboxColumn']
];


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => 'Header Before 1', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                ['content' => 'Header Before 2', 'options' => ['colspan' => 4, 'class' => 'text-center warning']],
                ['content' => 'Header Before 3', 'options' => ['colspan' => 3, 'class' => 'text-center warning']],
            ],
            'options' => ['class' => 'skip-export'] // remove this row from export
        ]
    ],
    'toolbar' => [
        ['content' =>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-primary btn-xs', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default btn-sm ', 'title' => Yii::t('kvgrid', 'Reset Grid')])
        ],
        '{export}',
        '{toggleData}'
    ],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'floatHeader' => true,
    //'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
    'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY
    ],
]);

/*
  echo GridView::widget([
  'dataProvider' => $dataProvider,
  'filterModel' => $searchModel,
  'tableOptions' => [
  'class' => 'table table-striped table-bordered table-light',
  ],
  'columns' => [
  ['class' => 'yii\grid\SerialColumn'],
  // Simple columns defined by the data contained in $dataProvider.
  // Data from the model's column will be used.
  'orderNo',
  'createDateTime:date',
  [
  'attribute' => 'createDateTime',
  'format' => ['date', 'php:Y-m-d']
  ],
  // More complex one.
  ['class' => 'yii\grid\ActionColumn',
  'header' => 'Actions',
  'template' => ' {Order} ',
  'buttons' => [
  'Order' => function($url, $model, $baseUrl) {
  return Html::a('<img src = "' . Yii::$app->homeUrl . 'images/payment-method/eye_vision_Bitcoin_card_currency_money_payment_finance-20.png" alt = "Cost Fit">', Yii::$app->homeUrl . "profile/purchase-order?orderId=" . $model->orderId, [
  'title' => Yii::t('app', 'test '),]);
  },
  ]
  ],
  ], 'layout' => "{pager}\n{items}\n",
  ]);
 * *
 */
?>
<!--
<script src="http://demos.krajee.com/assets/prod/all-krajee.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-radio.min.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-expand.min.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-editable.min.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-checkbox.min.js"></script>
<script src="http://demos.krajee.com/assets/925bede4/dist/js/bootstrap-dialog.min.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-export.min.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-toggle.min.js"></script>
<script src="http://demos.krajee.com/assets/97ea3ae0/yii.gridView.js"></script>
<script src="http://demos.krajee.com/assets/552fe155/js/bootstrap-datepicker.min.js"></script>
<script src="http://demos.krajee.com/assets/552fe155/js/datepicker-kv.min.js"></script>
<script src="http://demos.krajee.com/assets/421d41d2/js/editable-pjax.min.js"></script>
<script src="http://demos.krajee.com/assets/ffd6edac/js/bootstrap-popover-x.min.js"></script>
<script src="http://demos.krajee.com/assets/9c9d4f21/js/bootstrap-touchspin.min.js"></script>
<script src="http://demos.krajee.com/assets/adee4ef/js/kv-grid-action.min.js"></script>
<script src="http://demos.krajee.com/assets/df001713/jquery.pjax.js"></script>
-->