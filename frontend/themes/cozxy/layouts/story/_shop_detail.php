<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">Shop Detail</p>
        </div>
        <div class="col-xs-12 bg-white">
            <div class="size12 size10-xs">&nbsp;</div>

            <h3 class="page-header">Shop Name</h3>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-responsive size20">
                        <tr>
                            <th style="border-right:1px solid #aaa;width:200px;">Product</th>
                            <td style="padding-left:30px;">Cozxy Product</td>
                        </tr>
                        <tr>
                            <th style="border-right:1px solid #aaa;width:200px;">Price</th>
                            <td style="padding-left:30px;">1,234,567.89</td>
                        </tr>
                        <tr>
                            <th style="border-right:1px solid #aaa;width:200px;">Corporate Office</th>
                            <td style="padding-left:30px;">Nordstrom Direct Inquiries 1600 Seventh Avenue, Suite 2600 Seattle, WA 98101</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <?=Html::img(Url::home().'images/content/freitag1.jpg', ['class'=>'img-responsive'])?>
                </div>
            </div>

            <div class="size18 size14-xs">&nbsp;</div>

            <p class="size24">Map</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d124008.92046473033!2d100.48062576799724!3d13.762055508253102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x30e29ebe74b07b57%3A0x1892d37c43ed15a7!2z4LiV4Lil4Liy4LiU4Lio4Lij4Li14LiU4Li04LiZ4LmB4LiU4LiH!3m2!1d13.7620654!2d100.55066629999999!5e0!3m2!1sth!2sth!4v1494639156559" frameborder="0" style="width:100%;height:50vh;border:0" allowfullscreen></iframe>

        </div>

    </div>
</div>

<div class="size32">&nbsp;</div>