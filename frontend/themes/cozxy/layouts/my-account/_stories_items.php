<style type="text/css">
    .card {
        padding-top: 20px;
        margin: 10px 0 20px 0;
        background-color: #ffffff;
        border: 1px solid #d8d8d8;
        border-top-width: 0;
        border-bottom-width: 2px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }


    .card.hovercard {
        position: relative;
        /*width: 300px;*/
        padding-top: 0;
        overflow: hidden;
        text-align: center;
        background-color: #fff;
    }

    .card.hovercard img {
        width: 300px;
        height: 200px;
    }

    .card.hovercard .avatar {
        position: relative;
        top: -40px;
        margin-bottom: -40px;
    }

    .card.hovercard .avatar img {
        width: 80px;
        height: 80px;
        max-width: 80px;
        max-height: 80px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
    }

    .card.hovercard .info {
        padding: 4px 8px 10px;
    }

    .card.hovercard .info .title {
        margin-bottom: 4px;
        font-size: 24px;
        line-height: 1;
        color: #262626;
        vertical-align: middle;
    }

    .card.hovercard .info .desc {
        overflow: hidden;
        font-size: 12px;
        line-height: 20px;
        color: #737373;
        text-overflow: ellipsis;
    }

    .card.hovercard .bottom {
        padding: 0 20px;
        margin-bottom: 17px;
    }

    .card.people .card-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        display: inline-block;
        width: 100%;
        padding: 10px 20px;
        line-height: 29px;
        text-align: center;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
</style>
<div class="col-md-3 col-sm-6 item-to-stories-<?= $model['productPostId'] ?>"  style=" padding: 5px; ">
    <!--<div class="col-sm-3" style=" padding: 2px; ">-->
    <div class="card hovercard product-img">
        <img id="viewPost" data-src="holder.js/64x64" src="<?= $model['image'] ?>" class="fullwidth">
        <div class="avatar">
            <a href="<?= $model['url']; ?>">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt=""/>
            </a>
        </div>
        <div class="info">
            <div class="title" style="height:40px;">
                <a href="<?= $model['url']; ?>" class="fc-black"><?= $model['title'] ?></a>
            </div>
            <div class="desc"><?= $model['head'] ?></div>
            <div class="desc">
                <i class="fa fa-eye" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10)"><?= $model['views'] ?></span>&nbsp;
                <i class="fa fa-star" style="color:#989898;"></i>&nbsp;<span style="color:rgb(254, 230, 10); "><?= $model['star'] ?></span>
            </div>
            <div class="desc"></div>
        </div>
        <div class="bottom">
            <button class="b btn-black e-stories" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="<?= $model['productPostId'] ?>">Edit</button>
        </div>
    </div>
</div>
