<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="page-header">
    <h1>
        <span class="text-light-gray">
            <span class="iconfa-plus-sign"></span> คุณกำลังดูหน้าจอ  / </span>ตรวจสอบรายละะอียดสินค้าของ PO : <?= $_POST['poQrcode'] ?>
    </h1>
</div> <!-- / .page-header -->

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <?=
            $this->render('po-scan', [
            ])
            ?>
        </div>
        <div class="panel-body">

            <ul id="uidemo-tabs-default-demo" class="nav nav-tabs">
                <li class="active">
                    <a href="#uidemo-tabs-default-demo-home" data-toggle="tab">ข้อมูลใบสั่งซื้อ </a>
                </li>
                <li class="">
                    <a href="#uidemo-tabs-default-demo-profile" data-toggle="tab">สินค้า <span class="badge badge-success"><?= isset($poItems->allModels) ? count($poItems->allModels) : '0' ?></span></a>
                </li>
            </ul>

            <div class="tab-content tab-content-bordered">
                <div class="tab-pane fade active in" id="uidemo-tabs-default-demo-home">
                    <p>
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $poContent,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/modules/inbound/views/check-po-items/items/po-info', ['model' => $model, 'index' => $index]);
                            },
                            // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                        ]);
                        ?>
                    </p>
                </div> <!-- / .tab-pane -->
                <div class="tab-pane fade" id="uidemo-tabs-default-demo-profile">
                    <p><table class="table table-hover" id="inputs-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>สินค้า</th>
                                <th>บาร์โค้ด</th>
                                <th>จำนวนคงเหลือ</th>
                                <th>หน่วยนับ</th>
                                <th>ราคาขาย</th>
                                <th class="text-right">เมนู&nbsp;&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo \yii\widgets\ListView::widget([
                                'dataProvider' => $poItems,
                                'options' => [
                                    'tag' => false,
                                ],
                                'itemView' => function ($model, $key, $index, $widget) {
                                    return $this->render('@app/modules/inbound/views/check-po-items/items/po-items-items', ['model' => $model, 'index' => $index]);
                                },
                                // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                                //'layout'=>"{summary}{pager}{items}"
                                'layout' => "{items}",
                                'itemOptions' => [
                                    'tag' => false,
                                ],
                            ]);
                            ?>
                        </tbody>
                    </table>
                    <br><br><br><br><br><br>
                    </p>
                </div> <!-- / .tab-pane -->
            </div> <!-- / .tab-content -->
        </div>

    </div>
</div>
