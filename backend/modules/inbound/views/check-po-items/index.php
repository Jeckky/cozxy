<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="page-header">
    <h1><span class="text-light-gray">Form Inbound / </span>Check Po Items</h1>
</div> <!-- / .page-header -->

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading" style="background-color: #000000;">
                <span class="panel-title" style=" color: #fff;">Check Po Items :: form</span>
            </div>
            <div class="panel-body">
                <div class="col-md-3">&nbsp;</div>
                <?php
                $form = ActiveForm::begin([
                    'method' => 'GET',
                    'action' => ['inbound/check-po-items?boxcode='],
                ]);
                ?>
                <div  class="col-md-6">
                    <input type="email" class="form-control col-md-10" id="exampleInputEmail2" placeholder="Scan Qr Code ">
                </div>
                <?= $this->registerJS("
                                    $('#orderNo').blur(function(event){
                                        if(event.which == 13 || event.keyCode == 13)
                                        {
                                           $('#form').submit();
                                        }
                                    });
                        ") ?>
                <?php ActiveForm::end(); ?>
                <div class="col-md-3">&nbsp;</div>
            </div>
        </div>
        <!-- /5. $INLINE_FORM -->

    </div>
</div>
