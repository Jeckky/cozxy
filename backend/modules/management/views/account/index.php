<?php
/* @var $this yii\web\View */
?>
<h1>account/index</h1>

<p>
<div class="row">
    <div class="col-sm-12">

        <!-- 6. $HORIZONTAL_FORM =======     Horizontal form  ========= -->
        <form action="" class="panel form-horizontal">
            <div class="panel-heading">
                <span class="panel-title">เปลี่ยนรหัสผ่าน</span>
            </div>
            <div class="panel-body">
                <div class="row form-group">
                    <label class="col-sm-4 control-label">รหัสผ่านปัจจุบัน</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-4 control-label">รหัสผ่านใหม่</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-4 control-label">ยืนยันรหัสผ่าน</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
        <!-- /6. $HORIZONTAL_FORM -->
    </div>
</div>
</p>
