<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
$UserAgent = common\helpers\GetBrowser::UserAgent();
\frontend\assets\NewCozxyAsset::register($this);
$numRow = count($numRow) / 4;
?>
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <h4>POPULAR BRANDS</h4>
                    <div style=" border-top:  1px solid #000000; height: 10px;"></div>
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $brand,
                            'summary' => "",
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layoutsV2/brands/_brand_v2', ['model' => $model, 'index' => $index]);
                            },
                            //'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
                            'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="size6 bg-white">&nbsp;</div>

<div class="bg-white wrapper-cozxy" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="all-brands">
                    <h4>ALL BRANDS</h4>
                    <div style=" border-top: 1px solid #000000; height: 10px;"></div>
                    <div class="carousel-inner <?= ($UserAgent == 'mobile') ? '' : 'col-lg-offset-1' ?>">
                        <?php
                        foreach ($alphabet as $a => $value) {
                            ?>
                            <div class="col-xs-6 col-md-3 col-xs-6 cell-<?= $a ?>">
                                <div id="brands-alphabet"  style="padding-left: 0px; padding-right: 0px;  ">
                                    <h2> <?= $value ?></h2>
                                    <div class="carousel-inner-brands-alphabet " style=" padding: 0 0px 0px 0px;">
                                        <?php
                                        foreach ($testBrands[$value] as $key => $items) {
                                            //echo '<pre>';
                                            //print_r($items->attributes['brandId]);
                                            foreach ($items as $key => $list) {
                                                ?>
                                                <p>
                                                    <a href="<?php echo Yii::$app->homeUrl . 'search/brand/' . common\models\ModelMaster::encodeParams(['brandId' => $items->attributes['brandId']]); ?>"><?= $list; ?></a>
                                                </p>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="size6 bg-white">&nbsp;</div>