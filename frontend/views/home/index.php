<?php
/* @var $this yii\web\View */


\frontend\assets\NewCozxyAsset::register($this);

$this->title = 'test new themes cozxy.com - Buy what fuels your passion';
?>


<?php if (isset($slideGroup)): ?>
    <div class="bg-white rela">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $slideGroup,
                    'summary' => "",
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/cozxy/layouts/_slide_rev1', ['model' => $model, 'index' => $index]);
                    },
                    // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    //'layout' => "{items}",
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>

            </div>

            <!-- Left and right controls -->
            <a class="align-middle fc-black mca" href="#myCarousel" data-slide="prev" style="left:0">
                <span class="glyphicon glyphicon-menu-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="align-middle fc-black mca" href="#myCarousel" data-slide="next" style="right:0">
                <span class="glyphicon glyphicon-menu-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
<?php endif; ?>



<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">

                <style>
                    .container-x{
                        padding-left: 55px; padding-right: 55px;
                    }
                    /* carousel */
                    .media-carousel
                    {
                        margin-bottom: 0;
                        padding: 0 40px 30px 40px;
                        margin-top: 30px;
                    }
                    /* Previous button  */
                    .media-carousel .carousel-control.left
                    {
                        left: -12px;
                        background-image: none;
                        /*background: none repeat scroll 0 0 #222222;
                        border: 4px solid #FFFFFF;
                        border-radius: 23px 23px 23px 23px;*/
                        height: 40px;
                        width : 40px;
                        margin-top: 90px
                    }
                    /* Next button  */
                    .media-carousel .carousel-control.right
                    {
                        right: -12px !important;
                        background-image: none;
                        /*background: none repeat scroll 0 0 #222222;
                        border: 4px solid #FFFFFF;
                        border-radius: 23px 23px 23px 23px;*/
                        height: 40px;
                        width : 40px;
                        margin-top: 90px;
                    }
                    /* Changes the position of the indicators */
                    .media-carousel .carousel-indicators
                    {
                        right: 50%;
                        top: auto;
                        bottom: 0px;
                        margin-right: -19px;
                    }
                    /* Changes the colour of the indicators */
                    .media-carousel .carousel-indicators li
                    {
                        background: #c0c0c0;
                    }
                    .media-carousel .carousel-indicators .active
                    {
                        background: #333333;
                    }
                    .media-carousel img
                    {
                        /*width: 250px;
                        height: 100px;*/
                    }
                    .thumbnail {
                        border-radius: 0px;
                    }
                    /* End carousel */
                </style>
                <div class="carousel slide media-carousel" id="media">
                    <div class="carousel-inner">
                        <div class="item  active">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                                <div class="col-md-2">
                                    <a class="thumbnail" href="#"><img alt="" src="http://localhost/cozxy/frontend/web/images/ProductImageSuppliers/thumbnail1/o0ds5kPtaMtBG2z4_9vwvO52zW3op_zl.jpg"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a data-slide="prev" href="#media" class="left carousel-control fc-black mca"><span class="glyphicon glyphicon-menu-left"></span>
                        <span class="sr-only">Previous</span></a>
                    <a data-slide="next" href="#media" class="right carousel-control fc-black mca"><span class="glyphicon glyphicon-menu-right"></span>
                        <span class="sr-only">Next</span></a>
                    <!--
                <a class="align-middle fc-black mca" href="#myCarousel" data-slide="prev" style="left:0">
                    <span class="glyphicon glyphicon-menu-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="align-middle fc-black mca" href="#myCarousel" data-slide="next" style="right:0">
                    <span class="glyphicon glyphicon-menu-right"></span>
                    <span class="sr-only">Next</span>
                </a>-->
                </div>

            </div>
        </div>
    </div>
</div>