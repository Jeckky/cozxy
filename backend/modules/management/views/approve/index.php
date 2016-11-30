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
                            return '<button class="btn btn-warning  btn-xs investigate-approve" data-toggle="modal" data-bind="' . $model->productSuppId . ',1"  >ตรวจสอบ ProductID : <code>' . $model->productSuppId . '</code></button>';
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
                            return '<button class="btn btn-warning btn-xs investigate-approve" data-toggle="modal" data-bind="' . $model->productId . ',2">ตรวจสอบ ProductID : <code>' . $model->productId . '</code></button>';
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
<div id="myModal-investigate-approve" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Modal View Product</h4>
            </div>
            <div class="modal-body">
                <!--<h4>Text in a modal</h4>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                <hr>-->
                <table id="w0" class="table table-striped table-bordered detail-view">
                    <tbody>
                        <tr>
                            <th>Product ID</th>
                            <td class="view-product-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>User ID</th>
                            <td class="view-user-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Product Group ID</th>
                            <td class="view-product-group-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Brand ID</th>
                            <td class="view-brand-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Category ID</th>
                            <td class="view-category-id">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Isbn</th>
                            <td class="view-isbn">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Code</th>
                            <td class="view-code">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td class="view-title">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Option Name</th>
                            <td class="view-option-name">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td class="view-short-description">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td class="view-description">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Specification</th>
                            <td class="view-specification">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Width</th>
                            <td class="view-width">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Height</th>
                            <td class="view-height">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Depth</th>
                            <td class="view-depth">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Weight</th>
                            <td class="view-weight">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td class="view-price">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <td class="view-unit">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Small Unit</th>
                            <td class="view-small-unit">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td class="view-tags">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Create Date Time</th>
                            <td class="view-create-date-time">&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Update Date Time</th>
                            <td class="view-update-date-time">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- / .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->