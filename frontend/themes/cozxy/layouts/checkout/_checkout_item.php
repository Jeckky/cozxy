<?php
use yii\helpers\Html;
use yii\helpers\Url;

$id = uniqid();
?>
<div class="cart-detail">
    <div class="row">
        <div class="col-sm-2"><?=Html::img(Url::home().'imgs/product12.jpg', ['class'=>'img-responsive'])?></div>
        <div class="col-sm-6">
            <p class="size20">QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG</p>
            <p>
                <span class="size18"><span class="multi-<?=$id?>"></span> 43,000 THB</span> &nbsp;
            </p>
        </div>
        <div class="col-sm-4 fc-g666">
            <table style="width:100%">
                <tr>
                    <td>Quatity</td>
                    <td style="width:32px">:</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>:</td>
                    <td>Red</td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td>:</td>
                    <td>Medium</td>
                </tr>
            </table>
        </div>
    </div>
</div>
