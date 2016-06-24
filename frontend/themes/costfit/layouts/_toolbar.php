<div class="toolbar-container">
    <div class="container">
        <!--Toolbar-->
        <div class="toolbar group">
            <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i
                    class="icon-profile"></i> <span><b>L</b>ogin</span></a>

            <a class="btn-outlined-invert" href="<?=Yii::$app->homeUrl?>wishlist"><i class="icon-heart"></i>
                <span><b>W</b>ishlist</span></a>

            <?=$this->render('_cart')?>

            <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>
        </div><!--Toolbar Close-->
    </div>
</div>