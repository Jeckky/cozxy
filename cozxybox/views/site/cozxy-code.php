<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<style>
    body{
        background-image: url("<?=Url::home()?>images/bg.png");
    }
</style>

<img src="<?=Url::home()?>images/cozxy-code/header.png" alt="" style="position: absolute;left:0px;top:40px;">

<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <input type="text" class="form-control input-lg" style="border: 0px;height:60px;">
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <table>
            <tr>
                <td><img src="<?=Url::home()?>images/btn/btn7.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn8.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn9.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btnCancel.png" alt=""></td>
            </tr>
            <tr>
                <td><img src="<?=Url::home()?>images/btn/btn7.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn8.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn9.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btnCancel.png" alt=""></td>
            </tr>
            <tr>
                <td><img src="<?=Url::home()?>images/btn/btn7.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn8.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn9.png" alt=""></td>
                <td></td>
            </tr>
            <tr>
                <td><img src="<?=Url::home()?>images/btn/btn7.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn8.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btn9.png" alt=""></td>
                <td><img src="<?=Url::home()?>images/btn/btnCancel.png" alt=""></td>
            </tr>
        </table>
    </div>
</div>
