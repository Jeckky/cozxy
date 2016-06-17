<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>HOW TO SHOW PRODUCT</h2>

        <!--<p class="lead">You have successfully created your Yii-powered application.</p>-->

        <!--<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">
        <div class="row">
            <?php
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => common\models\costfit\Category::find(),
            ]);
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_category', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
//            'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}"
            ])
            ?>
        </div>
    </div>
</div>
