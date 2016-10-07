<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = 'Lockers List';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<h1>shippings demo/index</h1>

<div class="panel">


</div>
<div class="order-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?> ( Lockers ที่ว่าง )</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">

        </div>
    </div>

</div>