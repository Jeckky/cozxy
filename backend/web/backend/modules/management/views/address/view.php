<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Address */

$this->title = $model->addressId;
$this->params['breadcrumbs'][] = ['label' => 'Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="address-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->addressId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->addressId], [
                'class' => 'btn btn-xs btn-outline btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]) ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
            					'addressId',
					'userId',
					'firstname',
					'lastname',
					'company',
					'tax',
					'address:ntext',
					'countryId',
					'provinceId',
					'amphurId',
					'districtId',
					'zipcode',
					'tel',
					'type',
					'isDefault',
					'status',
					'createDateTime',
					'updateDateTime',
					'longitude',
					'latitude',
					'email:email',
					'fax',
            ],
            ]) ?>
                    </div>
    </div>

</div>
