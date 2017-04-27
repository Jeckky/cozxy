<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <span class="panel-title"><?= $title ?></span>
            </h4>
        </div>
        <div id="collapseBrand" class="panel-collapse ">

            <div class="panel panel-info" style="margin-top: 20px">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">Brand Search</div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                    $form = ActiveForm::begin([
                        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                    ]);
                    ?>
                    <div class = "input-append col-lg-4">
                    <!--<input type = "text" class = "search-query" placeholder = "Search"> -->
                        <?php
                        $searchText = isset($_POST["searchText"]) ? $_POST["searchText"] : NULL;
                        ?>
                        <?= Html::textInput("searchText", $searchText, ['placeHolder' => 'Beand Title', 'class' => 'form-control']);
                        ?>

                    </div>
                    <div class="col-lg-8">
                        <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                        <?= Html::a("<span class='fa fa-refresh'></span> Reset", Yii::$app->homeUrl . "margin/margin/brand-margin", ['class' => 'btn btn-danger']); ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <table class="table table-bordered table-hover table-striped">
                <thead >
                    <tr>
                        <th style="text-align: center;vertical-align: middle;font-weight: bold">Seq</th>
                        <th style="text-align: center;vertical-align: middle;font-weight: bold">Brand</th>
                        <th style="text-align: center;vertical-align: middle;font-weight: bold">Margin (%)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST["searchText"])) {
                        $where = "status = 1 AND title like '%" . $_POST["searchText"] . "%'";
                    } else {
                        $where = "status = 1 ";
                    }
                    $brands = \common\models\costfit\Brand::find()->where($where)->orderBy("title ASC")->all();
                    ?>
                    <?php
                    $seq = 1;
                    foreach ($brands as $brand):
                        ?>
                        <tr>
                            <th><?= $seq; ?></th>
                            <th><?= $brand->title; ?></th>
                            <th><?php
                                $margin = \common\models\costfit\Margin::getBrandMargin($brand->brandId, true);
                                echo isset($margin) ? $margin : "<span class='label label-danger'>Not Set</span>";
                                ?></th>
                            <th><?= Html::a("<span class='fa fa-edit'></span>Margin", Yii::$app->homeUrl . "margin/margin/brand-margin-update?brandId=" . $brand->brandId . "&searchText=" . $searchText, ['class' => 'btn btn-xs ']); ?></th>
                        </tr>
                        <?php
                        $seq++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>