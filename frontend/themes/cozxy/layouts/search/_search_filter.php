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
                <div class="dropdown-menu menu-filter-price">
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
                                    <input type="hidden" name='categoryId' id="categoryId" value="<?php echo $categoryId; ?>">
                                </div>
                                <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR ALL</u></a> &nbsp;
                                <a href="javascript:filterPriceCozxy()" class="b btn-black-s size16">APPLY</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown items">
                <div class="dropdown-toggle size18 size16-sm size14-xs"  data-toggle="dropdown">BRAND &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <div class="dropdown-menu menu-filter-brand">
                    <div class="row input-group">
                        <form method="post" action="">
                            <?php
                            if (isset($productFilterBrand)) {
                                if (count($productFilterBrand->allModels) > 0) {
                                    foreach ($productFilterBrand->allModels as $key => $value) {
                                        ?>
                                        <div class="col-sm-6"><label><input type="checkbox" name="brandId" value="<?php echo $value['brandId'] ?>"> &nbsp; <?php echo $value['title']; ?></label></div>
                                        <?php
                                    }
                                } else {

                                }
                                ?>
                                <div class="col-sm-12 text-right">
                                    <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR ALL</u></a> &nbsp;
                                    <a href="javascript:filterBrandCozxy(<?php echo $categoryId; ?>)" class="b btn-black-s size16">APPLY</a>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <!--
            <div class="dropdown items">
                <div class="dropdown-toggle size18 size16-sm size14-xs"  data-toggle="dropdown">COLOUR &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <div class="dropdown-menu">
                    <div class="row input-group">
                        <form method="post" action="">
                            <div class="col-sm-4"><label><input type="checkbox" name="color1"> &nbsp; Black</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color2"> &nbsp; White</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color3"> &nbsp; Red</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color4"> &nbsp; Yellow</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color5"> &nbsp; Purple</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color6"> &nbsp; Grey</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color7"> &nbsp; Green</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color8"> &nbsp; Pink</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="color9"> &nbsp; Orange</label></div>
                            <div class="col-sm-12 text-right">
                                <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR</u></a> &nbsp;
                                <a href="#" class="b btn-black-s size16">APPLY</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown items">
                <div class="dropdown-toggle size18 size16-sm size14-xs"  data-toggle="dropdown">CATEGORIES &nbsp; <i class="fa fa-angle-down" aria-hidden="true"></i></div>
                <div class="dropdown-menu">
                    <div class="row input-group">
                        <form method="post" action="">
                            <div class="col-sm-4"><label><input type="checkbox" name="type1"> &nbsp; Bag</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type2"> &nbsp; T-Shirt</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type3"> &nbsp; Bottoms</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type4"> &nbsp; Pants</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type5"> &nbsp; Watch</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type6"> &nbsp; Shoes</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type7"> &nbsp; Ring</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type8"> &nbsp; Hat</label></div>
                            <div class="col-sm-4"><label><input type="checkbox" name="type9"> &nbsp; Clothing</label></div>
                            <div class="col-sm-12 text-right">
                                <a href="javascript:filterPriceCozxyClear()"><u class="fc-black">CLEAR</u></a> &nbsp;
                                <a href="#" class="b btn-black-s size16">APPLY</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>