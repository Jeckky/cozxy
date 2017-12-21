<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\costfit\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supplier Address';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="supplier-index">

    <div class="panel panel-default">
        <div class="panel-heading"  style="background-color: #000;vertical-align: middle;">
            <span class="panel-title"><h3 style="color:#ffcc00;"><?= $this->title ?></h3></span>
        </div>

        <div class="panel-body">
            <?php if (isset($model)) { ?>
                <table class="table">
                    <tr>
                        <td style="width: 40%;">NAME</td>
                        <td><?= $model->firstname . ' ' . $model->lastname ?></td>
                    </tr>
                    <tr>
                        <td>COMPANY NAME</td>
                        <td><?= $model->company ?></td>
                    </tr>
                    <tr>
                        <td>TAX ID</td>
                        <td><?= $model->tax ?></td>
                    </tr>
                    <tr>
                        <td>MOBILE PHONE NUMBER</td>
                        <td><?= $model->tel ?></td>
                    </tr>
                    <tr>
                        <td >FAX</td>
                        <td><?= $model->fax ?></td>
                    </tr>
                    <tr>
                        <td>E-MAIL ADDRESS</td>
                        <td><?= $model->email ?></td>
                    </tr>
                    <tr>
                        <td>ADDRESS</td>
                        <td><?= User::supplierAddressText($model->addressId) ?></td>
                    </tr>
                </table>
                <div class="col-md-12 text-right">
                    <a href="create-supplier-address" class="btn btn-lg btn-warning">UPDATE</a>
                </div>
            <?php } else {
                ?>
                <div class="col-md-12 text-right">
                    <a href="create-supplier-address" class="btn btn-lg btn-success"><b>+</b> Create Supplier's Address</a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
