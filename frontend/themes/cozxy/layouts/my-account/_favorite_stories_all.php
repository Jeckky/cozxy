<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row bg-white">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <div class="size20 size18-xs col-lg-7 col-md-7 col-sm-6 col-xs-6"><?= $title ?></div>
            <div class="size20 size18-xs col-lg-5 col-md-5 col-sm-6 col-xs-6 pull-right text-right" >
                <a href="<?= Yii::$app->homeUrl ?>my-account?act=my-shelves" style="color: black;"> << Back to wishlist</a>
            </div>
        </div>

        <div class="row" style="padding: 20px;">
            <?=
            \yii\widgets\ListView::widget([
                'dataProvider' => $favoriteStory,
                'options' => [
                    'tag' => false,
                ],
                'itemView' => function ($model) {
                    return $this->render('@app/themes/cozxy/layouts/my-account/_favorite_stories_items', ['model' => $model]);
                },
                //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout' => "{items}{pager}",
                'layout' => "{items}",
                'itemOptions' => [
                    'tag' => false,
                ],
            ]);
            ?>
        </div>
    </div>
</div>
