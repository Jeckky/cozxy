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
        <div class="form-group has-warning simple form-inline">
            <!--<label class="control-label" for="inputWarning-42">Input with scan</label>-->
            <input type="text" class="has-warning form-control" id="poQrcode" name="poQrcode" placeholder="Scan Qr Code Po" value="<?= isset($_POST['poQrcode']) ? $_POST['poQrcode'] : '' ?>" style="width: 450px;">
            <button class="btn btn-primary" type="submit">Submit Or Enter</button>
            <p class="help-block">&nbsp;</p>
        </div>
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