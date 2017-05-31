<div class="product-detail">
    <div class="row">
        <div class="col-md-8 product-gallery">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <img src="<?php echo $model['image'] ?>" class="fullwidth" alt=" ">
                </div>
                <?php
                $productimageThumbnail1 = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTE2IiBoZWlnaHQ9IjExNiIgdmlld0JveD0iMCAwIDY0IDY0IiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48IS0tDQpTb3VyY2UgVVJMOiBob2xkZXIuanMvMTE2eDExNg0KQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4NCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQ0KKGMpIDIwMTItMjAxNSBJdmFuIE1hbG9waW5za3kgLSBodHRwOi8vaW1za3kuY28NCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWMwYTg2ZjY1YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YzBhODZmNjVhIj48cmVjdCB3aWR0aD0iMTE2IiBoZWlnaHQ9IjExNiIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjYuMjI2NTYyNSIgeT0iMzYuNTMyODEyNSI+MTE2eDExNjwvdGV4dD48L2c+PC9nPjwvc3ZnPg==';
                if (count($model['images']) == 0) {
                    for ($index = 0; $index <= 3; $index++) {
                        echo ''
                        . '<div class="col-md-3 col-xs-6">
                            <img src="' . $productimageThumbnail1 . '" class="fullwidth" alt="" style="margin-top: 24px;">
                        </div>';
                    }
                } else {
                    foreach ($model['images'] as $key => $value) {
                        echo ''
                        . '<div class="col-md-3 col-xs-6">
                            <img src="' . $value['imageThumbnail1'] . '" class="fullwidth" alt="" style="margin-top: 24px;">
                        </div>';
                    }
                }
                ?>
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
                                <input type="text" id="quantity" name="quantity" class="quantity" value="1">
                                <a href="javascript:;" class="q-plus"><i class="fa fa-plus-circle" aria-hidden="true" style="color: #000"></i></a>
                            </div>
                        </div>
                        <hr>
                        <div class="size36">&nbsp;</div>
                        <div class="text-center abs" style="bottom: 0; left: 0; right: 0;">
                            <input type="hidden" id="maxQnty" value="<?php echo $model['result']; ?>">
                            <input type="hidden" id="fastId" value="">
                            <input type="hidden" id="productId" value="<?php echo $model['productId']; ?>">
                            <input type="hidden" id="supplierId" value="<?php echo $model['supplierId']; ?>">
                            <input type="hidden" id="productSuppId" value="<?php echo $model['productSuppId']; ?>">
                            <input type="hidden" id="receiveType" value="<?php echo $model['receiveType']; ?>">
                            <a href="#" class="b btn-g999 size16" style="margin:24px auto 12px">+
                                <i class="fa fa-heart"></i></a>
                            <?php
                            if ($model['result'] > 0) {
                                echo '<a href="#" id="addItemToCartUnity" class="b btn-yellow size16" style="margin:24px auto 12px">+
                                <i class = "fa fa-shopping-cart"></i></a>';
                            } else {
                                echo ' ';
                            }
                            ?>
                            <a href = "/cart" class = "b btn-g999 btn-success size16" style = "margin:24px auto 12px;color:#fff;">+
                                <i class = "fa fa-bookmark-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>