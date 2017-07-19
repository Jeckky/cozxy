<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="panel-heading" style="background-color: #000000;">
    <span class="panel-title" style=" color: #fff;">Check Po Items :: form</span>
</div>
<div class="panel-body">
    <div class="col-md-3">&nbsp;</div>
    <?php
    $form = ActiveForm::begin([
        'method' => 'POST',
    //'action' => ['check-po-items?boxcode='],
    ]);
    ?>
    <div  class="col-md-6">
        <input type="text" class="form-control" id="poQrcode" name="poQrcode" placeholder="Scan Qr Code Po" value="<?= isset($_POST['poQrcode']) ? $_POST['poQrcode'] : '' ?>">
    </div>
    <?= $this->registerJS("
                        $('#poQecode').blur(function(event){
                            if(event.which == 13 || event.keyCode == 13)
                            {
                               $('#form').submit();
                            }
                        });
                 ") ?>
    <?php ActiveForm::end(); ?>
    <div class="col-md-3">&nbsp;</div>
</div>