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

//echo '<pre>';
//print_r($productLastDay);
?>
<h1>ค่าเฉลี่ยการค้า/จำนวนสินค้าที่ขายได้</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<div class="product-price-suppliers-index">
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel-heading">
        <h2>ระยะเวลาที่ขายได้ล่าสุด :: 13 ธันวาคม 2559</h2>
    </div>
    <div class="panel-body">
        <?=
        GridView::widget([
            'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
            'dataProvider' => $productLastDay,
            'pager' => [
                'options' => ['class' => 'pagination pagination-xs']
            ],
            'rowOptions' => function ($model, $index, $widget, $grid) {

            },
            'options' => [
                'class' => 'table-light'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'conutProduct',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->conutProduct;
                    }
                ],
            ],
        ]);
        ?>
        <table class="table" style="border-top: 0px ; margin-top: 0px; margin-top: -5px;">
            <tr style="border-top: 0px ; margin-top: 0px;">
                <td style="border-top: 0px ; margin-top: 0px;">&nbsp;</td>
                <td class="text-right" style="border-top: 0px ; margin-top: 0px;">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                <td style="border-top: 0px ; margin-top: 0px;">&nbsp;</td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        <h2>ระยะเวลาที่ขายได้ 7 วันล่าสุด :: 6 ธันวาคม 2559  - 13 ธันวาคม 2559</h2>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>จำนวนสินค้า</th>
                    <th>ราคารวม</th>
                    <th>ระยะเวลา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                foreach ($productLastWeek as $value) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$num; ?></th>
                        <td><?php //echo $value['conutProduct'];                                                                                                       ?>test</td>
                        <td>test</td>
                        <td>6 ธันวาคม 2559  - 13 ธันวาคม 2559 </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel-heading">
        <h2>ระยะเวลาที่ขายได้ 14 วันล่าสุด :: 29 พฤศจิกายน 2559  - 13 ธันวาคม 2559</h2>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>จำนวนสินค้า</th>
                    <th>ราคารวม</th>
                    <th>ระยะเวลา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                foreach ($product14LastWeek as $value) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$num; ?></th>
                        <td><?php //echo $value['conutProduct'];                                                                                                       ?>test</td>
                        <td>test</td>
                        <td>29 พฤศจิกายน 2559  - 13 ธันวาคม 2559</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel-heading">
        <h2>ระยะเวลาที่ขายได้ 1 เดือนล่าสุด :: 13 พฤศจิกายน 2559  - 13 ธันวาคม 2559</h2>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>จำนวนสินค้า</th>
                    <th>ราคารวม</th>
                    <th>ระยะเวลา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num = 1;
                foreach ($orderLastMONTH as $value) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo ++$num; ?></th>
                        <td><?php //echo $value['conutProduct'];                                                                          ?>test</td>
                        <td>test</td>
                        <td>13 พฤศจิกายน 2559  - 13 ธันวาคม 2559</td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td class="text-right">เฉลี่ยจำนวนชิ้นที่ขาย</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th scope="row">&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
