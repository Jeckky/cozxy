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
                            <th>Description </th>
                            <td>
                                <div id="description" class="collapse">
                                    <?= $model->description; ?>
                                </div>
                                <button class="btn btn-warning" data-toggle="collapse" data-target="#description">Hide/Show</button>
                            </td>
                        </tr>
                        <tr>
                            <th>Specification </th>
                            <td>
                                <div id="specification" class="collapse">
                                    <?= $model->specification; ?>
                                </div>
                                <button class="btn btn-warning" data-toggle="collapse" data-target="#specification">Hide/Show</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?= $this->render("_product_grid", ["dataProvider" => $dataProvider]); ?>


            <?= $this->render("_product_grid", ["dataProvider" => $dataProvider, 'gridTitle' => "<span style='color:white;font-weight:bold'>My Product</span>", 'type' => 2]); ?>

            <div style="position:fixed;bottom:5px;right:20px;margin:0;padding:5px 3px;background-color: rgba(224,224,224,0.8);text-align: center;border: 3px green solid">
                <h3 style="color: tomato">Create My Product ?</h3>
                <a  href="#" class="btn btn-success btn-lg">Create</a>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
