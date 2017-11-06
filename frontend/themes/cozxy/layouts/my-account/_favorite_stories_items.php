<style type="text/css">

</style>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 item-to-stories-<?= $model['productPostId'] ?>  "  style=" padding: 0px; " id="itemStory-<?= $model['productPostId'] ?>">
    <!--<div class="col-sm-3" style=" padding: 2px; ">-->
    <div class="card hovercard product-img">
        <img id="viewPost" data-src="holder.js/64x64" src="<?= $model['image'] ?>" class="fullwidth"  style="border-top: 1px #d8d8d8 solid;border-bottom: 1px #d8d8d8 solid;">

        <div class="avatar">
            <a href="<?= $model['url']; ?>">
                <img src="<?= $model['avatar']; ?>" alt=""/>
            </a>
        </div><br>
        <div class="info text-center">
            <div class="title" >
                <a href="<?= $model['url']; ?>" class="fc-black size14 b"><?= $model['head'] ?></a>
            </div>
            <div class="desc" ><?= $model['title'] ?></div>
            <div class="desc">
                <i class="fa fa-eye" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10)"><?= $model['views'] ?></span>&nbsp;
                <i class="fa fa-star" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10); "><?= $model['star'] ?></span>
            </div>
        </div>

        <div class="bottom text-center">
            <a class="b btn-black btn-xs " href="<?= $model['url'] ?>" style=" padding: 3px 6px;">View Stories</a>
            <a class="b btn-black btn-xs " href="<?= $model['urlProduct'] ?>" style=" padding: 3px 6px;">View Product</a>
            <a class="b btn-black btn-xs " href="javascript:deleteItemFromFav(<?= $model['productPostId'] ?>);" style=" padding: 3px 6px;" id="reFav">Remove</a>

        </div> 
    </div>
</div>
