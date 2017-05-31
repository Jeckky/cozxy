<nav class="menu">
    <div class="container">
        <?php echo $this->render('_nav_main_menu') ?>
    </div>

    <div class="catalog-block ">
        <div class="container">
            <?php echo $this->render('_nav_sub_menu') ?>
        </div>
    </div>
</nav>

<div class="toolbar-container">
    <div class="container">
        <!--Toolbar-->
        <div class="toolbar group">
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-profile"></i> <span><b>Login</span></a>

            <?php } else { ?>
                <a class="btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>wishlist"><i class="icon-heart"></i> <span><b>W</b>ishlist</span></a>
            <?php } ?>

            <!--Cart Dropdown-->
            <?= $this->render('_cart') ?>
            <!--Cart Dropdown Close-->
            <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>
        </div><!--Toolbar Close-->
    </div>
</div>