<?php
use yii\helpers\Html;
use yii\helpers\Url;

$id = uniqid();
$val = rand(1, 10);
?>
<div class="cart-detail">
    <div class="row">
        <div class="col-sm-3"><?=Html::img(Url::home().'imgs/product12.jpg', ['class'=>'img-responsive'])?></div>
        <div class="col-sm-5">
            <p class="size20">QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG</p>
            <p>
                <span class="size18"><span class="multi-<?=$id?>"></span> 43,000 THB</span> &nbsp;
                <span class="size14 onsale">54,000 THB</span>
            </p>
            <div class="col-xs-12 size18">
                <a href="javascript:qSet('<?=$id?>',-1);"><i class="fa fa-minus-circle" aria-hidden="true" style="color: #000"></i></a>
                <input type="text" name="quantity" class="quantity quantity-<?=$id?>" value="<?=$val?>">
                <a href="javascript:qSet('<?=$id?>',1);"><i class="fa fa-plus-circle" aria-hidden="true" style="color: #000"></i></a>
            </div>
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
                   