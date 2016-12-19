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

<div class="product-price-suppliers-index ">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class=" panel colourable col-sm-6" >
        <div class="panel-heading ">
            <span class="panel-title text-danger">ระยะเวลาที่ขายได้ล่าสุด ::
                <span class="text-primary">
                    <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?>
                </span>
            </span>
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
                        <td><?php echo isset($productLastDay->conutProduct) ? number_format($productLastDay->conutProduct, 0) : '0'; ?>&nbsp;ชิ้น</td>
                        <td><?php echo isset($productLastDay->summaryPrice) ? number_format($productLastDay->summaryPrice, 2) : '0'; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-success text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td class="text-success limiter-count"><?php echo number_format($productLastDay->avgNum, 2); ?>&nbsp;ชิ้น/วัน </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class=" panel colourable col-sm-6" >
        <div class="panel-heading">
            <span class="panel-title text-danger">ระยะเวลาที่ขายได้ 7 วันล่าสุด ::
                <span class="text-primary">
                    <?php echo $this->context->dateThai(date('Y-m-d', strtotime("-7 day")), 1, TRUE); ?>  - <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?>
                </span>
            </span>
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
                        <td><?php echo isset($productLastWeek->conutProduct) ? number_format($productLastWeek->conutProduct, 0) : '0'; ?>&nbsp;ชิ้น</td>
                        <td><?php echo isset($productLastWeek->summaryPrice) ? number_format($productLastWeek->summaryPrice, 2) : '0'; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-success text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td class="limiter-count text-success "><?php echo number_format($productLastWeek->avgNum, 2); ?>&nbsp;ชิ้น/วัน </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class=" panel colourable col-sm-6" >
        <div class="panel-heading">
            <span class="panel-title text-danger">
                ระยะเวลาที่ขายได้ 14 วันล่าสุด ::
                <span class="text-primary">
                    <?php echo $this->context->dateThai(date('Y-m-d', strtotime("-14 day")), 1, TRUE); ?> - <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?>
                </span>
            </span>
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
                        <td><?php echo isset($product14LastWeek->conutProduct) ? number_format($product14LastWeek->conutProduct, 0) : '0'; ?>&nbsp;ชิ้น</td>
                        <td><?php echo isset($product14LastWeek->summaryPrice) ? number_format($product14LastWeek->summaryPrice, 2) : '0'; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-success text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td class="limiter-count text-success "><?php echo number_format($product14LastWeek->avgNum, 2); ?>&nbsp;ชิ้น/วัน </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class=" panel colourable col-sm-6" >
        <div class="panel-heading">
            <span class="panel-title text-danger">
                ระยะเวลาที่ขายได้ 1 เดือนล่าสุด ::
                <span class="text-primary">
                    <?php echo $this->context->dateThai(date('Y-m-d', strtotime("-1 month")), 1, TRUE); ?>  - <?php echo $this->context->dateThai(date("Y-m-d"), 1, TRUE); ?>
                </span>
            </span>
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
                        <td><?php echo isset($orderLastMONTH->conutProduct) ? number_format($orderLastMONTH->conutProduct, 0) : '0'; ?>&nbsp;ชิ้น</td>
                        <td><?php echo isset($orderLastMONTH->summaryPrice) ? number_format($orderLastMONTH->summaryPrice, 2) : '0'; ?>&nbsp;บาท</td>
                    </tr>
                    <tr>
                        <td class="text-success text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                        <td class="limiter-count text-success "><?php echo number_format($orderLastMONTH->avgNum, 2); ?>&nbsp;ชิ้น/วัน </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
