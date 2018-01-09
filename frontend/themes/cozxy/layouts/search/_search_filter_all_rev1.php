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
                                    <input type="hidden" name="min" id="min" value="100">
                                    <input type="hidden" name="max" id="max" value="100">
                                    <input type="hidden" name="search" id="search" value="<?= $search ?>">
                                </div>
                                <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR ALL</u></a> &nbsp;
                                <a href="javascript:filterBrandAndCategoryCozxyApi()" class="b btn-black-s size16">APPLY</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown items">
                <div class="dropdown-toggle size18 size16-sm size14-xs"  data-toggle="dropdown">BRAND &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <div class="dropdown-menu menu-filter-brand " style="<?= ($UserAgent == 'mobile') ? 'min-width:256px;' : 'min-width: 460px;' ?> ">
                    <div class="row input-group">
                        <form method="post" action="">
                            <?php
                            if (isset($productFilterBrand)) {
                                if (count($productFilterBrand->allModels) > 0) {
                                    foreach ($productFilterBrand->allModels as $key => $value) {
                                        ?>
                                        <div class="col-sm-6"><label><input type="checkbox" name="brandId" value="<?= $value['brandId'] ?>"> &nbsp; <?= $value['title']; ?></label></div>
                                        <?php
                                    }
                                } else {

                                }
                                ?>
                                <div class="col-sm-12 text-right">
                                    <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR ALL</u></a> &nbsp;
                                    <a href="javascript:filterBrandAndCategoryCozxyApi()" class="b btn-black-s size16">APPLY</a>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>