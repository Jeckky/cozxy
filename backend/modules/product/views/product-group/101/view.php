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
                        <tr>
                            <th>Status </th>
                            <td style="vertical-align: middle;font-weight: bold">

                                <?= ($model->status == 1) ? "Approve" : ($model->status == 99 ? "Wait Approve " . Html::a("Back To Draft", Yii::$app->homeUrl . "product/product-group/back-to-draft?id=$model->productId", ['class' => 'btn btn-danger']) : "Draft at Step " . $model->step ); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li role="presentation" class=" <?= (isset($_GET['tab'])) ? (($_GET['tab'] == 1) ? "active in " : " ") : "active in " ?>  ">
                        <a href="#masterProduct" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Master Product (<?= $dataProvider->getTotalCount() ?>)</a>
                    </li>
                    <?php if (!$isMaster): ?>
                        <li role="presentation" class=" <?= (isset($_GET['tab'])) ? (($_GET['tab'] == 2) ? "active in " : " ") : "active in " ?>  ">
                            <a href="#myProduct" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">My Product (<?= $dataProvider2->getTotalCount() ?>)</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade <?= (isset($_GET['tab'])) ? (($_GET['tab'] == 1) ? "active in " : " ") : "active in " ?>  " role="tabpanel" id="masterProduct" aria-labelledby="home-tab">
                        <?= $this->render("_product_grid", ["dataProvider" => $dataProvider]); ?>
                    </div>
                    <?php if (!$isMaster): ?>
                        <div class="tab-pane fade  <?= (isset($_GET['tab'])) ? (($_GET['tab'] == 2) ? "active in " : " ") : "active in " ?>  " role="tabpanel" id="myProduct" aria-labelledby="profile-tab">
                            <?php if ($dataProvider2->getTotalCount() > 0): ?>
                                <?= $this->render("_product_grid", ["dataProvider" => $dataProvider2, 'gridTitle' => "<span style='color:white;font-weight:bold'>My Product</span>", 'type' => 2, 'isProductSupp' => TRUE]); ?>
                            <?php else: ?>
                                <center>
                                    <h3>Create My Product</h3>
                                    <a  href="<?= Yii::$app->homeUrl . "product/product-group/create-my-product?productGroupId=" . $_GET["productGroupId"]; ?>" class="btn btn-success btn-lg">Create</a>
                                </center>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>




            <div id="actionBtn" style="position:fixed;bottom:5px;right:20px;margin:0;padding:5px 3px;background-color: rgba(224,224,224,0.8);text-align: center;border: 3px green solid">
                <a class="pull-right" style="margin:0;color:red" onclick="$('#actionBtn').hide()" ><i class="glyphicon glyphicon-remove"></i></a>
                <?php
                $user_group_Id = Yii::$app->user->identity->user_group_Id;
                $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
                $userEx = explode(',', $userRe);
                $ress = array_search(26, $userEx);
                $productGroup = \common\models\costfit\Product::find()->where("productId=" . $_GET["productGroupId"])->one();
                if ($ress !== FALSE && $productGroup->status == 99) {
                    ?>
                    <?php // echo Html::a("<i class='glyphicon glyphicon-check'></i> Approve", ['approve-product-group', 'id' => $_GET["productGroupId"]], ['class' => 'btn btn-warning']) ?>
                    <h3 style="color: tomato">Approve Product Supplier ?</h3>
                    <a  href="<?= Yii::$app->homeUrl . "product/product-group/approve-my-product?productGroupId=" . $_GET["productGroupId"] . "&userId=" . $userId; ?>" class="btn btn-warning btn-lg"><i class='glyphicon glyphicon-check'></i> Approve</a>
                    <?php
                } else {
                    ?>
                    <?php if ($dataProvider2->getTotalCount() == 0): ?>
                        <h3 style="color: tomato">Create My Product ?</h3>
                        <a  href="<?= Yii::$app->homeUrl . "product/product-group/create-my-product?productGroupId=" . $_GET["productGroupId"]; ?>" class="btn btn-success btn-lg">Create</a>
                        <?php
                    else:
                        $countDraft = \common\models\costfit\ProductSuppliers::find()
                        ->join("RIGHT JOIN", "product p", "p.productId = product_suppliers.productId")
                        ->join("RIGHT JOIN", "product pg", "pg.productId = p.parentId")
                        ->where("pg.productId = " . $_GET["productGroupId"] . " AND product_suppliers.userId = " . $userId . " AND product_suppliers.status = 0")
                        ->count();
                        $countWaitApprove = \common\models\costfit\ProductSuppliers::find()
                        ->join("RIGHT JOIN", "product p", "p.productId = product_suppliers.productId")
                        ->join("RIGHT JOIN", "product pg", "pg.productId = p.parentId")
                        ->where("pg.productId = " . $_GET["productGroupId"] . " AND product_suppliers.userId = " . $userId . " AND product_suppliers.status = 99")
                        ->count();
                        ?>
                        <?php if ($countDraft > 0): ?>
                            <h3 style="color: tomato">Send Approve My Product ?</h3>
                            <a  href="<?= Yii::$app->homeUrl . "product/product-group/send-approve-my-product?productGroupId=" . $_GET["productGroupId"] . "&userId=" . $userId; ?>" class="btn btn-success btn-lg">Send Approve</a>
                        <?php endif; ?>
                        <?php if ($countWaitApprove > 0 && $ress !== FALSE): ?>
                            <h3 style="color: tomato">Approve Product Supplier ?</h3>
                            <a  href="<?= Yii::$app->homeUrl . "product/product-group/approve-my-product?productGroupId=" . $_GET["productGroupId"] . "&userId=" . $userId; ?>" class="btn btn-warning btn-lg"><i class='glyphicon glyphicon-check'></i> Approve</a>
                        <?php endif; ?>
                    <?php
                    endif;
                }
                ?>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
