<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Product in Product Group ';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>



    <div class="panel panel-default" >
        <div class="panel-heading" style="background-color: #000;vertical-align: middle;">
            <div class="row">
                <div class="col-md-6">
                    <span class="panel-title"><h3 style="color:#ffcc00;vertical-align: middle;"><?= $this->title ?></h3></span>
                </div>
                <div class="col-md-6" style="vertical-align: bottom;">
                    <div class="btn-group pull-right" >
                        <?php
                        if (Yii::$app->user->identity->type == 4) {
                            echo Html::a("<i class='fa fa-plus'></i> Create My Product Group", ['create?step=1'], ['class' => 'btn btn-success',
                                'style' => 'height:35px;color:#FFF;']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 ">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th style="width: 10%">Product Group</th>
                            <td><?= $model->title; ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= $model->description; ?></td>
                        </tr>
                        <tr>
                            <th>Specification</th>
                            <td><?= $model->specification; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?= $this->render("_product_grid", ["dataProvider" => $dataProvider]); ?>

        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
