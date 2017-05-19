<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<section class="catalog-grid">

    <div class="container">
        <div  class="col-md-12 " style=" background-color: rgba(255,212,36,.9); ">
            <h3 style=" margin-left: 2px;">Products' Stories All</h3>
        </div>
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $productPost,
                'options' => [
                    'id' => 'see-more',
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('product-see-more', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                'layout' => "{items}{pager}",
                //    'layout' => "{items}",
                'pager' => [
                    //            'firstPageLabel' => 'first',
                    //            'lastPageLabel' => 'last',
                    'prevPageLabel' => '<span class="icon-arrow-left"></span>',
                    'nextPageLabel' => '<span class="icon-arrow-right"></span>',
                    //            'maxButtonCount' => 3,
                    // Customzing options for pager container tag
                    //            'options' => [
                    //                'tag' => 'div',
                    //                'class' => 'pager-wrapper',
                    //                'id' => 'pager-container',
                    //            ],
                    // Customzing CSS class for pager link
                    //            'linkOptions' => ['class' => 'mylink'],
                    //            'activePageCssClass' => 'active',
                    //            'disabledPageCssClass' => 'mydisable',
                    // Customzing CSS class for navigating link
                    'prevPageCssClass' => 'prev-page',
                    'nextPageCssClass' => 'next-page',
                //            'firstPageCssClass' => 'myfirst',
                //            'lastPageCssClass' => 'mylast',
                ],
            ])
            ?>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><div class="views-title" style="font-weight: bold;"></div></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="views-shortDescription" style="font-size: 14px; color: #292c2e;"></div>
                <hr>
                <div class="views-description" style="font-size: 14px; color: #292c2e;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn btn-black btn-xs" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

    // Get the modal
    function views_click(productPostId, productSuppId, productId) {
        //alert(productPostId);
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: $baseUrl + "reviews/views-posts",
            data: {productPostId: productPostId, productSuppId: productSuppId, productId: productId},
            success: function (data, status)
            {
                //alert(status);
                if (status == "success") {
                    //var json = data;
                    var rex = /(<([^>]+)>)/ig;
                    //alert(txt.replace(rex, ""));
                    //var Num = 1;
                    console.log(data.title);
                    var title = data.title;
                    var shortDescription = data.shortDescription;
                    var description = data.description;
                    $('.views-title').html('<i class="fa fa-pencil" aria-hidden="true"></i> ' + title);
                    $('.views-shortDescription').html(shortDescription);
                    $('.views-description').html(description);
                }
            }
        });
        $('#myModal').modal('show')
    }

    function ViewsShows() {
        var x = document.getElementById("brand-carousel-reviews").classList;
        //alert(x);
        if (x == 'brand-carousel') {
            $('#brand-carousel-reviews').removeClass("show");
            $('#brand-carousel-reviews').addClass("hide");
            $('.add-new-icon').html('<h3 style="text-decoration: underline;">Post <i class="fa fa-minus-circle" aria-hidden="true" style="zoom: .7"></i></h3>');
        } else if (x == 'brand-carousel show') {
            $('#brand-carousel-reviews').removeClass("show");
            $('#brand-carousel-reviews').addClass("hide"); //fa fa-minus-circle
            $('.add-new-icon').html('<h3 style="text-decoration: underline;">Post <i class="fa fa-minus-circle" aria-hidden="true" style="zoom: .7"></i></h3>');
        } else {
            $('#brand-carousel-reviews').removeClass("hide");
            $('#brand-carousel-reviews').addClass("show");
            $('.add-new-icon').html('<h3 style="text-decoration: underline;">Post <i class="fa fa-plus-circle" aria-hidden="true" style="zoom: .7"></i></h3>');
        }

        //$("#brand-carousel-reviews").removeClass("hide");
    }

</script>