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
                        'attribute' => 'ตรวจสอบข้อมูล',
                        'format' => 'raw',
                        'value' => function($model) {
                            return '<button class="btn btn-warning  btn-xs" data-toggle="modal" data-target="#myModal">ตรวจสอบ ProductID : <code>' . $model->productSuppId . '</code></button>';
                        }
                    ],
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
                /* ['class' => 'yii\grid\ActionColumn',
                  'header' => 'Actions',
                  'template' => '{view}',
                  'buttons' => [
                  'view' => function ($url, $model) {
                  return Html::a('<i class="fa fa-eye"></i>', $url, [
                  'title' => Yii::t('yii', 'view'),
                  ]);
                  }
                  ]
                  ], */
                ],
            ]);
            ?>
        </div>
    </div>
</div>.

<div class="panel colourable">
    <div class="panel-heading">
        <span class="panel-title"> <h4>  รายการสินค้าที่ต้อง Approve ของ<code>Cozxy.com</code> </h4></span>
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
                        'attribute' => 'ตรวจสอบข้อมูล',
                        'format' => 'raw',
                        'value' => function($model) {
                            return '<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">ตรวจสอบ ProductID : <code>' . $model->productSuppId . '</code></button>';
                        }
                    ],
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
                /* ['class' => 'yii\grid\ActionColumn',
                  'header' => 'Actions',
                  'template' => '{view}',
                  'buttons' => [
                  'view' => function ($url, $model) {
                  return Html::a('<i class="fa fa-eye"></i>', $url, [
                  'title' => Yii::t('yii', 'view'),
                  ]);
                  }
                  ]
                  ], */
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

        });

        //alert(switcherEl.switcher('setValue', true));
        //console.log($('#switchers-colors-square').switcher({}));
    });



</script>
<!-- / Javascript -->

<!-- 5. $DEFAULT_MODAL ===================Default modal============================= -->
<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
            </div>
            <div class="modal-body">
                <h4>Text in a modal</h4>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>

                <h4>Popover in a modal</h4>
                <p>This <a href="#" role="button" class="btn btn-default popover-test" title="" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="A Title">button</a> should trigger a popover on click.</p>

                <h4>Tooltips in a modal</h4>
                <p><a href="#" class="tooltip-test" title="" data-original-title="Tooltip">This link</a> and <a href="#" class="tooltip-test" title="" data-original-title="Tooltip">that link</a> should have tooltips on hover.</p>

                <hr>

                <h4>Overflowing text to show scroll behavior</h4>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div> <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->