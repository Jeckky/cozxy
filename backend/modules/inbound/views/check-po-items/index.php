<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="page-header">
    <h1>
        <span class="text-light-gray">คุณกำลังดูหน้าจอ / </span>ตรวจสอบรายละะอียดสินค้าของ PO
    </h1>
</div> <!-- / .page-header -->

<div class="row">
    <div class="col-sm-12">
        <?=
        $this->render('items/po-scan', [
        ])
        ?>
    </div>
</div>
