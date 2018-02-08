<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;

\frontend\assets\NewCozxyAsset::register($this);
?>
<div class="bg-white" >
    <div class="container-x">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <h1>POPULAR BRANDS</h1>
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
                            // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                            //'layout'=>"{summary}{pager}{items}"
                            //'layout' => "{items}",
                            'itemOptions' => [
                                'tag' => false,
                            ],
                        ]);
                        //foreach ($productBrand as $brand) {
                        //echo $this->render('@app/themes/cozxy/layouts/_brand_rev1', ['model' => $brand]);
                        //}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
