
<!-- Categories Nav [PC] -->
<div class="bg-white menubar hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <a href="#" class="menu-category" data-toggle="collapse" data-target="#categories" style="color: #000000;">CATEGORIES &nbsp;</a>
            <a href="#" class="menu-category-clearance" data-toggle="collapse" data-target="#categories-clearance" style="color:#ca0909;">CLEARANCE &nbsp;</a>
            <a href="#" class="menu-category-pomotion" data-toggle="collapse" data-target="#categories-pomotion" style="color: #000000;">POMOTION &nbsp;</a>
            <a href="#" class="menu-category-brands" data-toggle="collapse" data-target="#categories-brands" style="color: #000000;">BRANDS <span class="size12">(mouse over)</span>&nbsp;</a>
        </div>
    </div>
</div>

<!--/ categories / -->
<div class="categories-submenu hidden-sm hidden-xs">
    <div class="collapse" id="categories">
        <div class="container" style="max-height:500px; min-height: 500px; background-color: #fff;">
            <div class="row-cozxy">
                <!-- Main Category -->
                <div class="col-lg-2 col-md-4" style="border-right: solid 1px #ccc;">
                    <div class="row main-category">
                        <?php
                        foreach ($this->params['cate'] as $key => $value) {
                            ?>
                            <div class="menu-item sub-<?= $value['categoryId'] ?>"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($value['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $value['categoryId']]) ?>" onmouseover="categoryLoad(<?= $value['categoryId'] ?>);" style=" background-color: #fff;"><?= $value['title'] ?></a><a class="mob-only" href="javascript:categoryMob(<?= $value['categoryId'] ?>);"><i class="fa fa-angle-right size18"></i></a></div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Sub Category -->
                <div class="sr-only">
                    <!-- Item 1 -->
                    <?php
                    foreach ($this->params['actionTreeSub'] as $key => $value) {
                        //echo common\models\ModelMaster::createTitleArray($value['title']);
                        ?>
                        <div class="sub-item-<?= $value['categoryId'] ?>">
                            <?php
                            if (isset($value['Children'])) {
                                //echo 'count :' . count($value['Children']);
                                foreach ($value['Children'] as $key => $items) {
                                    ?>
                                    <div class="col-md-6">
                                        <div class="sub-cate col-md-12"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($items['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $items['categoryId']]) ?>" style=" font-weight: 900;"><?= strtoupper($items['title']) ?></a></div>
                                        <?php
                                        if (isset($items['Children'])) {
                                            ?>
                                            <div class="row sub-items col-md-12">
                                                <?php
                                                foreach ($items['Children'] as $key => $sub) {
                                                    ?>
                                                    <div class="col-md-12 subs-sub-titles"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($sub['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $sub['categoryId']]) ?>">– <?= $sub['title'] ?></a></div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <!-- Item End -->

                </div>
                <!-- End Category -->
                <div class="col-lg-6 col-md-8 sub2menu" style="display:none; ">
                    <div class="row loadCategory"></div>
                </div>
            </div>
            <!-- / Brands Form New Layout / -->
            <div class="col-lg-2 col-md-7 sub2menu" style="border-left: solid 1px #ccc; padding: 0px;">
                <div class="row main-category col-md-12" style="top:15px;">
                    <div class="col-md-12">
                        <a href="#" style=" font-weight:900; color: #000;">IN BRANDS </a>
                    </div>
                    <div class="col-md-12 sub-items" style="padding: 0px; margin-left: 20px;">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $this->params['brands'],
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) { //$widget,
                                //echo $model->productId, ',';
                                return $this->render('@app/themes/cozxy/layoutsV2/brands/_brand_menu_category_v2', ['model' => $model, 'index' => $index]);
                            },
                            // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout' => "{summary}{pager}{items}",
                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                                //'itemOptions' => ['class' => 'item'],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="categories-submenu-brands hidden-sm hidden-xs">
    <div class="collapse" id="categories">
        <div class="container" style="max-height:500px; min-height: 500px; background-color: #fff;">
            <div class="collapse" id="categories-brands">
                test's
            </div>
        </div>
    </div>
</div>
<!-- Categories Nav [SmartPhone] -->
<div class="bg-white menubar hidden-lg hidden-md">
    <div class="container">
        <div class="row">
            <a href="#" class="menu-category mobcategories">&nbsp; CATEGORIES &nbsp;</a><a href="#" class="menu-category mobcategories pull-right">&nbsp; <i class="fa fa-navicon size20"></i> &nbsp;</a>
        </div>
    </div>
</div>
<div class="xs-category" style="display:none;">
    <div class="mob-box">
        <div class="mob-category">
            <div class="bg-black"><a href="javascript:xscategoryOff();"><span class="fc-white size20">&nbsp; <i class="fa fa-close"></i> &nbsp; CLOSE</span></a></div>
            <div class="mob-maincate"></div>
        </div>
        <div class="mob-s-category">
            <div class="bg-black"><a href="javascript:xscategoryBack();"><span class="fc-white size20">&nbsp; <i class="fa fa-angle-left"></i> &nbsp; BACK</span></a></div>
            <div class="mob-subcate"></div>
        </div>
    </div>
</div>