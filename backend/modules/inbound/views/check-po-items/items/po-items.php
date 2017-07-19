<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="page-header">
    <h1>
        <span class="text-light-gray">คุณกำลังดูหน้าจอ  / </span>ตรวจสอบรายละะอียดสินค้าของ PO : <?= $_POST['poQrcode'] ?>
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
                    <a href="#uidemo-tabs-default-demo-home" data-toggle="tab">ข้อมูลใบสั่งซื้อ <span class="label label-success">12</span></a>
                </li>
                <li class="">
                    <a href="#uidemo-tabs-default-demo-profile" data-toggle="tab">สินค้า <span class="badge badge-primary">12</span></a>
                </li>

            </ul>

            <div class="tab-content tab-content-bordered">
                <div class="tab-pane fade active in" id="uidemo-tabs-default-demo-home">
                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                </div> <!-- / .tab-pane -->
                <div class="tab-pane fade" id="uidemo-tabs-default-demo-profile">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                </div> <!-- / .tab-pane -->
            </div> <!-- / .tab-content -->
        </div>

    </div>
</div>
