<?php
use yii\helpers\Html;
?>
<div class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="size30 b">SUBSCRIBE</div>
                <div class="size24">TO OUR NEWS &AMP; PROMOTION</div>
            </div>
            <div class="col-md-7">
                <div class="size12">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-9 col-xs-8"><input type="email" name="subscribe_email" class="subs-input" placeholder="ENTER YOUR EMAIL ADDRESS"></div>
                    <div class="col-sm-3 col-xs-4 text-right"><input type="submit" value="SUBMIT" class="subs-btn size14-xs"></div>
                    <div class="col-sm-12 col-xs-12"><hr></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-yellow1 footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8 footer-menu text-center-sm text-center-xs size18-sm size16-xs">
                <?=Html::a('About Us', ['/site/about']);?>
                <?=Html::a('Terms & Conditions', ['/site/terms-and-conditions']);?>
                <?=Html::a('FAQs', ['/site/faqs']);?>
                <?=Html::a('Contact Us', ['/site/contact']);?>
            </div>
            <div class="col-md-4 text-right hidden-sm hidden-xs">
                <a href="#" class="gotoTop fc-black"><div class="booticon"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></div> &nbsp; <span class="size18 b">GO TO TOP</span></a>
            </div>
        </div>
    </div>
</div>

<div class="bg-yellow3 copyright" style="border-bottom:2px solid #ffc600">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright-social text-center-sm text-center-xs">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-pinterest-p"></i></a>
            </div>
            <div class="col-md-6 text-right text-center-sm text-center-xs"><div class="size8">&nbsp;</div>
                Copyright &copy; 2017 all right reserved
            </div>
        </div>
    </div>
</div>

<div class="topOpener"></div>
<div class="hidden-md hidden-lg">
    <div class="gotoTop smallTop" style="display:none"><div class="align-middle middle-center" style="padding-top:8px"><span class="glyphicon glyphicon-menu-up"></span></div></div>
</div>