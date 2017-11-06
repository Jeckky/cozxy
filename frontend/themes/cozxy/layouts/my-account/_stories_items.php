<style type="text/css">

</style>

<div class="col-md-3 col-sm-6 item-to-stories-<?= $model['productPostId'] ?> card"  style=" padding: 5px;  border-top: 1px #d8d8d8 solid;">
    <!--<div class="col-sm-3" style=" padding: 2px; ">-->
    <div class=" hovercard product-img">
        <img id="viewPost" data-src="holder.js/64x64" src="<?= $model['image'] ?>" class="fullwidth"  style="border-bottom: 1px #d8d8d8 solid;">

        <div class="avatar">
            <a href="<?= $model['url']; ?>">
                <img src="<?= $model['avatar']; ?>" alt=""/>
            </a>
        </div><br>
        <div class="info text-center">
            <div class="title">
                <a href="<?= $model['url']; ?>" class="fc-black size14 b"><?= $model['head'] ?></a>
            </div>
            <div class="desc"><?= $model['title'] ?></div>
            <div class="desc">
                <i class="fa fa-eye" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10)"><?= $model['views'] ?></span>&nbsp;
                <i class="fa fa-star" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10); "><?= $model['star'] ?></span>
            </div>
            <div class="desc"></div>
        </div>
        <div class="bottom text-center">
            <div class="col-md-12" style="padding: 5px;">
                <a class="b btn-black btn-xs" href="<?= $model['urlEditStory'] ?>" style="padding: 3px 6px;">Edit Stories</a>
                <a id="removeItemStory-<?= $model['productPostId'] ?>" class="b btn-black btn-xs " href="javascript:StoriesRemove(<?= $model['productPostId'] ?>)" style=" padding: 3px 6px;">Remove Stories</a>
            </div>
            <div class="col-md-12" style="padding: 5px;">
                <a class="b btn-black btn-xs " href="<?= $model['url'] ?>" style=" padding: 3px 6px;">View Stories</a>
                <a class="b btn-black btn-xs " href="<?= $model['urlProduct'] ?>" style=" padding: 3px 6px;">View Product</a>
            </div>
        </div>

    </div>
</div>
