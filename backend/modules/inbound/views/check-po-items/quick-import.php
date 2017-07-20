<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="page-header">
    <h1>
        <span class="text-light-gray">คุณกำลังดูหน้าจอ / </span>นำเข้าสินค้า
    </h1>
</div> <!-- / .page-header -->

<div class="row">
    <div class="col-sm-12">
        <form action="" class="panel form-horizontal">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-5">
                        <div class="col-md-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">ต้นทุนปัจจุบัน</label>
                                <div class="well">
                                    marginValue
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">จำนวนปัจจุบัน</label>
                                <div class="well">
                                    Look, I'm in a well!
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">จำนวน <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Name" class="form-control form-group-margin">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">ต้นทุน/ชิ้น <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="Name" class="form-control form-group-margin">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">ผู้ส่งสินค้า <span class="text-danger">*</span></label>
                                <select class="form-control form-group-margin">
                                    <option>ผู้ส่งสินค้า 1</option>
                                    <option>ผู้ส่งสินค้า 2</option>
                                    <option>ผู้ส่งสินค้า 3</option>
                                    <option>ผู้ส่งสินค้า 4</option>
                                    <option>ผู้ส่งสินค้า 5</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">รูปแบบ Qrcode</label>
                            <div class="well">
                                <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=I+Love+QR+Codes!++HI+MOM!&choe=UTF-8">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">ประวัติการนำเข้าสินค้า  <small>(5 รายการล่าสุด)</small></label>
                            <div class="well">
                                Look, I'm in a well!
                            </div>
                        </div>
                    </div>

                </div><!-- row -->

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary">Send message</button>
            </div>
        </form>
    </div>
</div>
