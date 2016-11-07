<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\costfit\StoreProductGroup;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบ PO ที่ยังไม่ตรวจรับ / จัดเรียง';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-product-group-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #ccffcc;vertical-align: middle;">
            <div class="pull-right" style="margin-top: 10px;"><?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> สร้างใบ PO', ['create'], ['class' => 'btn btn-primary btn-lg pull-right']) ?></div>
            <span class="panel-title" style="vertical-align: middle;"><h3><?= $this->title ?>

                </h3></span>
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
//                    'storeProductGroupId',
                    [
                        'attribute' => 'supplierId',
                        'value' => function($model) {
                            return isset($model->supplier) ? $model->supplier->name : NULL;
                        }
                    ],
                    'poNo',
                    [
                        'attribute' => 'receiveDate',
                        'value' => function($model) {
                            return (isset($model->receiveDate) && $model->receiveDate != '0000-00-00 00:00:00') ? $this->context->dateThai($model->receiveDate, 2) : NULL;
                        }
                    ],
                    [
                        'attribute' => 'noProduct',
                        'label' => 'No. Of Product',
                        'value' => function($model) {
                            return count($model->storeProducts);
                        }
                    ],
                    [
                        'attribute' => 'summary',
                        'value' => function($model) {
                            return number_format($model->summary);
                        }
                    ],
                    // 'receiveBy',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete} {product} {qc} {arrange}',
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
                            'product' => function($url, $model) {
                                return Html::a('<br><u>Product</u>', ['/store/store-product', 'storeProductGroupId' => $model->storeProductGroupId], [
                                    'title' => Yii::t('app', 'Change today\'s lists'),]);
                            },
                            'qc' => function($url, $model) {
                                return Html::a('<br><u>ตรวจรับ</u>', ['/store/store-product/check', 'storeProductGroupId' => $model->storeProductGroupId], [
                                    'title' => Yii::t('app', 'check\'s lists'),]);
                            },
                            'arrange' => function($url, $model) {
                                return Html::a('<br><u>จัดเรียง</u>', ['/store/store-product/arrange', 'storeProductGroupId' => $model->storeProductGroupId], [
                                    'title' => Yii::t('app', 'check\'s lists'),]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #ccffff;">
            <span class="panel-title"><h3>รายการ PO ที่ตรวจรับ / จัดเรียงแล้ว</h3></span>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php
                $form = ActiveForm::begin([
                    'method' => 'GET',
                    'action' => ['index'],
                ]);
                ?>
                <div class="col-lg-3">
                    <?php
                    echo DatePicker::widget(['name' => 'fromDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'value' => isset($_GET['fromDate']) ? $_GET['fromDate'] : NULL,
                        'options' => ['placeholder' => 'From Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ]
                    ])
                    ?>

                </div> -
                <div class="col-lg-3">
                    <?=
                    DatePicker::widget(['name' => 'toDate',
                        'dateFormat' => 'yyyy-MM-dd',
                        'value' => isset($_GET['toDate']) ? $_GET['toDate'] : NULL,
                        'options' => ['placeholder' => 'To Date',
                            'class' => 'form-control',
                            'style' => 'border-color: #66CCFF;height: 40px;',
                            'language' => 'en',
                        ]
                    ])
                    ?>
                </div>
                <div class="col-lg-2">
                    <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true">  ค้นหา</i>', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <br>
            <table class="table table-bordered">

                <tr style="height: 50px;background-color: #F0FFFF;">
                    <th style="vertical-align: middle;text-align: center;width: 5%;">Supplier</th>
                    <th style="vertical-align: middle;text-align: center;width: 25%;">Po No</th>
                    <th style="vertical-align: middle;text-align: center;width: 20%;">Receive Date</th>
                    <th style="vertical-align: middle;text-align: center;width: 20%;">No. of product(s)</th>
                    <th style="vertical-align: middle;text-align: center;width: 20%;">Summary</th>
                    <th style="vertical-align: middle;text-align: center;width: 10%;">Status</th>
                </tr>
                <?php
                if (isset($passQc) && !empty($passQc)) {
                    $i = 1;
                    foreach ($passQc as $qc):
                        if ($qc->status == 2) {
                            $bg = '#FFFAFA';
                        } else if ($qc->status == 3) {
                            $bg = '#FAEBD7';
                        } else if ($qc->status == 4) {
                            $bg = '#F0FFF0';
                        } else if ($qc->status == 5) {
                            $bg = '#FFFACD';
                        }
                        ?>
                        <tr style="background-color: <?= $bg ?>">
                            <td style="vertical-align: middle;text-align: center;width: 5%;"><?= $i ?></td>
                            <td style="vertical-align: middle;text-align: center;width: 25%;"><?= $qc->poNo ?></td>
                            <td style="vertical-align: middle;text-align: center;width: 20%;"><?= isset($qc->receiveDate) ? $this->context->dateThai($qc->receiveDate, 2) : "-" ?></td>
                            <td style="vertical-align: middle;text-align: center;width: 20%;"><?= StoreProductGroup::countProducts($qc->storeProductGroupId) ?></td>
                            <td style="vertical-align: middle;text-align: right;width: 20%;"><?= $qc->summary ?></td>
                            <td style="vertical-align: middle;text-align: center;width: 10%;"><?= StoreProductGroup::getStatusText($qc->status) ?></td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                } else {
                    ?>
                    <tr>
                        <th style="vertical-align: middle;text-align: center;width: 5%;background-color:#cccccc;" colspan="4"><i><h4>ไม่มีรายการ PO</h4></i></th>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php Pjax::end(); ?>
    </div>
</div>