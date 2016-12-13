<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ค่าเฉลีย';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>ค่าเฉลี่ยการค้า/จำนวนสินค้าที่ขายได้</h1>

<div class="product-price-suppliers-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-info" style="font-size: 16px;">
        <div class="panel-heading ">
            <h4>ระยะเวลาที่ขายได้ล่าสุด :: 13 ธันวาคม 2559</h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>จำนวนสินค้าที่ขายได้</th>
                        <th>จำนวนเงินที่ได้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $productLastDay->conutProduct; ?>&nbsp;ชิ้น</td>
                        <td><?php echo $productLastDay->summaryPrice; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td><?php echo number_format($productLastDay->avgNum, 2); ?>&nbsp;ชิ้น/วัน</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-info" style="font-size: 16px;">
        <div class="panel-heading">
            <h4>ระยะเวลาที่ขายได้ 7 วันล่าสุด :: 6 ธันวาคม 2559  - 13 ธันวาคม 2559</h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>จำนวนสินค้าที่ขายได้</th>
                        <th>จำนวนเงินที่ได้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $productLastWeek->conutProduct; ?>&nbsp;ชิ้น</td>
                        <td><?php echo $productLastWeek->summaryPrice; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td><?php echo number_format($productLastWeek->avgNum, 2); ?>&nbsp;ชิ้น/วัน</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-info" style="font-size: 16px;">
        <div class="panel-heading">
            <h4>ระยะเวลาที่ขายได้ 14 วันล่าสุด :: 29 พฤศจิกายน 2559  - 13 ธันวาคม 2559</h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>จำนวนสินค้าที่ขายได้</th>
                        <th>จำนวนเงินที่ได้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $product14LastWeek->conutProduct; ?>&nbsp;ชิ้น</td>
                        <td><?php echo $product14LastWeek->summaryPrice; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td><?php echo number_format($product14LastWeek->avgNum, 2); ?>&nbsp;ชิ้น/วัน</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-info" style="font-size: 16px;">
        <div class="panel-heading">
            <h4>ระยะเวลาที่ขายได้ 1 เดือนล่าสุด :: 13 พฤศจิกายน 2559  - 13 ธันวาคม 2559</h4>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>จำนวนสินค้าที่ขายได้</th>
                        <th>จำนวนเงินที่ได้</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $orderLastMONTH->conutProduct; ?>&nbsp;ชิ้น</td>
                        <td><?php echo $orderLastMONTH->summaryPrice; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td><?php echo number_format($orderLastMONTH->avgNum, 2); ?>&nbsp;ชิ้น/วัน</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
