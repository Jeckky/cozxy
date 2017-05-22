<div class="product-detail">
    <div class="row">
        <div class="col-md-8 product-gallery">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <img src="/<?php echo $model['image'] ?>" class="fullwidth" alt=" ">
                </div>
                <?php
                foreach ($model['images'] as $key => $value) {
                    // echo $value['imageThumbnail1'] . '<br>';
                    ?>
                    <div class="col-md-3 col-xs-6">
                        <img src="/<?php echo $value['imageThumbnail1']; ?>" class="fullwidth" alt="Big Bag" style="margin-top: 24px;">
                    </div>
                    <?php
                }
                ?>
                <!--
                <div class="col-md-3 col-xs-6">
                    <img src="imgs/other01.jpg" class="fullwidth" alt="Big Bag" style="margin-top: 24px;">
                </div>
                <div class="col-md-3 col-xs-6">
                    <img src="imgs/other04.jpg" class="fullwidth" alt="Big Bag" style="margin-top: 24px;">
                </div>
                <div class="col-md-3 col-xs-6">
                    <img src="imgs/other05.jpg" class="fullwidth" alt="Big Bag" style="margin-top: 24px;">
                </div>
                <div class="col-md-3 col-xs-6">
                    <img src="imgs/other07.jpg" class="fullwidth" alt="Big Bag" style="margin-top: 24px;">
                </div>
                -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 col-xs-12 product-select bg-white">
                    <div class="product-form">
                        <h3 class="size20 size16-xs"><?php echo $model['title'] ?></h3>
                        <p class="size24 size20-xs b"><?php echo $model['price']; ?> THB</p>
                        <p class="size12 fc-g666">Category: <?php echo $model['category'] ?></p>
                        <hr>
                        <p><?php echo $model['shortDescription'] ?></p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 size18 b">COLOUR</div>
                            <div class="col-sm-6 text-right color-sel">
                                <a href="javascript:;" class="color-s"><i class="fa fa-circle" aria-hidden="true" style="color: #842"></i></a>
                                <a href="javascript:;" class="color-s"><i class="fa fa-circle" aria-hidden="true" style="color: #cbb"></i></a>
                                <a href="javascript:;" class="color-s"><i class="fa fa-circle" aria-hidden="true" style="color: #434"></i></a>
                                <a href="javascript:;" class="color-s"><i class="fa fa-circle" aria-hidden="true" style="color: #236"></i></a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 size18 b">QUANTITY</div>
                            <div class="col-sm-6 text-right quantity-sel size18">
                                <a href="javascript:;" class="q-minus"><i class="fa fa-minus-circle" aria-hidden="true" style="color: #000"></i></a>
                                <input type="text" name="quantity" class="quantity" value="<?php // echo $model['result']                                                  ?>">
                                <a href="javascript:;" class="q-plus"><i class="fa fa-plus-circle" aria-hidden="true" style="color: #000"></i></a>
                            </div>
                        </div>
                        <hr>
                        <div class="size36">&nbsp;</div>
                        <div class="text-center abs" style="bottom: 0; left: 0; right: 0;">
                            <a href="#" class="b btn-g999 size16" style="margin:24px auto 12px">+
                                <i class="fa fa-heart"></i></a>
                            <a href="/cart" class="b btn-yellow size16" style="margin:24px auto 12px">+
                                <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>