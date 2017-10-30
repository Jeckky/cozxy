<?php
$UserAgent = common\helpers\GetBrowser::UserAgent();
?>
<!-- Product Menu -->
<style type="text/css">
    .dropdown-menu {
        min-width: 460px;
    }
    .dropdown:hover > .dropdown-menu {
        display: block;
        margin-top: 0px;
    }
</style>
<div class="product-menu">
    <div class="container">
        <div class="row">
            <div class="dropdown items">
                <div class="dropdown-toggle size18 size16-sm size14-xs"  data-toggle="dropdown">PRICE &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <div class="dropdown-menu menu-filter-price" style="min-width:373px; max-width: 460px;">
                    <div class="row">
                        <form method="post" action="">
                            <div class="col-xs-10 col-xs-offset-1" style="margin-top: 24px;">
                                <div id="slider-range"></div>
                            </div>
                            <div class="col-xs-10 col-xs-offset-1 size18 size16-sm size14-xs" style="margin-top: 12px; margin-bottom: 24px;">
                                <input type="text" id="amount" readonly style="border:0; color:#000; font-weight:700; background-color: transparent; width: 100%;">
                            </div>
                            <div class="col-xs-12 text-right">
                                <div id="amount-min">
                                    <input type="hidden" name="min" id="min">
                                    <input type="hidden" name="max" id="max">
                                </div>
                                <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR ALL</u></a> &nbsp;
                                <a href="javascript:filterPriceByBrand()" class="b btn-black-s size16">APPLY</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>