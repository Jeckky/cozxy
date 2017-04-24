<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style type="text/css">
    /* #reviews-rate > img{
        width: 50px;
    }*/
    #reviews-rate > img {
        display: initial;
        max-width: 100%;
        height: auto;

    }
</style>
<!--Wishlist-->
<section class="wishlist">
    <div class="container">
        <div class="row">
            <!--Items List-->
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3>Product Post</h3>
                    <!--<form id="reviews-form" method="post" novalidate="novalidate">-->
                    <?php
                    $form = ActiveForm::begin([
                        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
                        'fieldConfig' => [
                            'template' => '{label}<div class="col-sm-9">{input}</div>',
                            'labelOptions' => [
                                'class' => 'col-sm-3 control-label'
                            ]
                        ]
                    ]);
                    ?>
                    <!--Left Column-->
                    <div class="col-lg-8 col-md-8 col-sm-8"><br>
                        <?php
                        if (Yii::$app->controller->action->id == 'create-post') {
                            ?>
                            <?= $form->field($model, 'title', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 100]) ?>
                            <?= $form->field($model, 'shortDescription', ['options' => ['class' => 'row form-group']])->textInput(['maxlength' => 200]) ?>
                            <?= $form->field($model, 'description', ['options' => ['class' => 'row col-lg-12']])->widget(\yii\redactor\widgets\Redactor::className()) ?>
                        <?php } ?>
                        <?php
                        if (Yii::$app->controller->action->id == 'create-review') {
                            ?>
                            <h3>Rating This Post</h3>
                            <div class="Reviews" style="margin-left: 10px;">
                                <h5>Rate this item</h5>
                                <?php
                                echo \yii2mod\rating\StarRating::widget([
                                    'name' => "input_name",
                                    'value' => 1,
                                    'options' => [
                                        // Your additional tag options
                                        'id' => 'reviews-rate',
                                    ],
                                    'clientOptions' => [
                                    // Your client options
                                    ],
                                ]);
                                ?><br><br>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <?= Html::submitButton($model->isNewRecord ? 'Create a review' : 'Update a review', ['class' => "btn btn-black btn-sm"]) ?>
                            </div>
                        </div>
                    </div>

                    <!--</form>-->
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3" style="margin-bottom: 20px;">
                <br><br><br>
            </div>
        </div>
    </div>
</section><!--Wishlist Close-->

<!--Catalog Grid-->

