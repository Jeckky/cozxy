<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Promotion';
$this->params['breadcrumbs'][] = $this->title;

\frontend\assets\NewCozxyAsset::register($this);
?>
<div class="bg-white wrapper-cozxy">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="carousel slide media-carousel" id="media1">
                    <h4>Promotion Cozxy</h4>
                    <div style=" border-top:  1px solid #000000; height: 10px;"></div>
                    <div class="carousel-inner">
                        <?php
                        echo \yii\widgets\ListView::widget([
                            'dataProvider' => $pomotion,
                            'options' => [
                                'tag' => false,
                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('@app/themes/cozxy/layoutsV2/promotion/_items_pomotion', ['model' => $model,
                                            'index' => $index
                                ]);
                            }, 'emptyText' => ' ',
                            // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
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
