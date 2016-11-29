<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>approve/index</h1>

<?php Pjax::begin(['id' => 'employee-grid-view']); ?>
<div class="panel colourable" id="switcher-examples">
    <div class="panel-heading">
        <span class="panel-title"> <h4>  รายการสินค้าที่ต้อง Approve ของ <code>Suppliers</code> </h4></span>
    </div>

    <div class="panel-body">
        <div class="col-sm-12 suppliers">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $productSupp,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'rowOptions' => function ($model, $index, $widget, $grid) {
                    return [
                        'id' => 'productSuppId-' . $model['productSuppId']
                    ];
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productSuppId',
                    //'userId',
                    //'productGroupId',
                    'isbn:ntext',
                    'code',
                    'title',
                    [
                        'attribute' => 'อนุมัติ',
                        'format' => 'raw',
                        'value' => function($model) {
                            $type = 'supp';
                            $approve_txt = '<div id="switchers-colors-square" class="form-group-margin"  onchange="switchers(' . $model->productSuppId . ',1)">';
                            if ($model->approve == 'new') {
                                $approve_txt .= '<input type="checkbox" data-class="switcher-warning" >';
                            } else {
                                $approve_txt .= '<input type="checkbox" data-class="switcher-warning"   checked="checked" >';
                            }
                            $approve_txt .= '</div>';
                            return $approve_txt;
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            }
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>.

<div class="panel colourable">
    <div class="panel-heading">
        <span class="panel-title"> <h4>  รายการสินค้าที่ต้อง Approve ของ <code>System</code> </h4></span>
    </div>

    <div class="panel-body">
        <div class="col-sm-12 system">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $productSys,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'rowOptions' => function ($model, $index, $widget, $grid) {
                    return [
                        'id' => 'productId-' . $model['productId']
                    ];
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productId',
                    //'userId',
                    //'productGroupId',
                    'isbn:ntext',
                    'code',
                    'title',
                    [
                        'attribute' => 'อนุมัติ',
                        'format' => 'raw',
                        'value' => function($model) {
                            $type = 'supp';
                            $approve_txt = '<div id="switchers-colors-square" class="form-group-margin"  onchange="switchers(' . $model->productId . ',2)">';
                            if ($model->approve == 'new') {
                                $approve_txt .= '<input type="checkbox" data-class="switcher-warning" >';
                            } else {
                                $approve_txt .= '<input type="checkbox" data-class="switcher-warning"   checked="checked" >';
                            }
                            $approve_txt .= '</div>';
                            return $approve_txt;
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            }
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>.
<?php Pjax::end(); ?>
<!-- 5. $SWITCHERS =============== Switchers ===============-->
<!-- Javascript -->
<script>
    init.push(function () {
        /*
         // Colors
         //$('#switchers-colors-default > input').switcher();
         $('#switchers-colors-square > input').switcher({
         theme: 'square',
         });
         //$('#switchers-colors-modern > input').switcher({theme: 'modern'});

         // Sizes
         //$('#switchers-sizes .switcher-example-default').switcher();
         $('#switchers-sizes .switcher-example-square').switcher({theme: 'square'});
         //$('#switchers-sizes .switcher-example-modern').switcher({theme: 'modern'});

         // Disabled state
         //$('#switcher-disabled-default').switcher();
         $('#switcher-disabled-square').switcher({theme: 'square'});
         //$('#switcher-disabled-modern').switcher({theme: 'modern'});

         $('#switcher-enable-all').click(function () {
         $('#switchers-disabled input').switcher('enable');

         });

         $('#switcher-disable-all').click(function () {
         $('#switchers-disabled input').switcher('disable');
         });


         */
        $('#switchers-colors-square > input').switcher(function (e, data) {
            alert('Test Yes !!');
        });

        //alert(switcherEl.switcher('setValue', true));
        //console.log($('#switchers-colors-square').switcher({}));
    });



</script>
<!-- / Javascript -->