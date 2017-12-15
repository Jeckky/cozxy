<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Promotion */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #000;color: #ffcc33;">
        <div class="row">
            <div class="col-md-6" style="font-size: 20pt;"> <?= Html::encode($this->title) ?> :: <?= $model->promotionCode ?></div>
            <div class="col-md-6">
                <div class="btn-group pull-right">

                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered" style="font-size: 12pt;">
            <tr>
                <td style="width:20%;">Title</td>
                <td><?= $model->title ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?= $model->description ?></td>
            </tr>
            <tr>
                <td>Promotion Code</td>
                <td><?= $model->promotionCode ?></td>
            </tr>
            <tr>
                <td>Discount</td>
                <td><?= $model->discount ?><?= $model->discountType == 1 ? ' % ' : 'cash ( THB )' ?></td>
            </tr>
            <tr>
                <td>Maximum Discount</td>
                <td><?= $model->maximumDiscount ?> (cash THB)</td>
            </tr>
            <tr>
                <td>Maximum Use</td>
                <td><?= $model->maximum ?> Time(s)</td>
            </tr>
            <tr>
                <td>1 user can use</td>
                <td><?= $model->perUser ?> Time(s)</td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td><?= $model->startDate ?></td>
            </tr>
            <tr>
                <td>End Date</td>
                <td><?= $model->endDate ?></td>
            </tr>
            <tr>
                <td>Brand</td>
                <td><?= $brands ?></td>
            </tr>
            <tr>
                <td>Category</td>
                <td><?= $categories ?></td>
            </tr>
        </table> <a class="btn btn-warning btn-lg pull-right" href="<?= Yii::$app->homeUrl ?>promotion/promotion"> << BACK </a>
    </div>


</div>
