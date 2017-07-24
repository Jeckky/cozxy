<div class="panel panel-defailt">
    <h3 class="page-header" style="margin:10px 20px;">Author</h3>
    <div class="panel-body text-center">
        <?php //$productImagesThumbnailNull = common\helpers\Base64Decode::DataImageSvg120x120(FALSE, FALSE, FALSE); ?>
        <!--<img src="<?php // $productImagesThumbnailNull     ?>" class="img-responsive" alt="Big Bag" style="">-->
        <a href="#">
            <img src="<?= isset($avatar) ? $avatar : 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' ?>" alt=""  class="img-responsive img-circle" style="zoom:0.5;">
        </a>
        <h4 class="size14"><?= common\models\costfit\User::userName($productPost->userId) ?></h4><hr>
        <p class="size14">

        </p>
    </div>
</div>

<style>
    .social-icon {
        padding: 14px 5px;
    }
    .social-icon a {
        display: inline-block;
        width: 42px;
        height: 42px;
        font-size: 24px;
        color: #fff;
        border-radius: 50%;
        border: 1px solid #fff;
        padding: 4px 6px;
        margin-left: 7px;
        margin-right: 7px;
        text-align: center;
        -webkit-transition: all .5s;
        transition: all .5s;
        background-color:rgb(255, 198, 0);
    }
</style>

<div class="panel panel-defailt text-center social-icon">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-pinterest-p"></i></a>
</div>
