<div class="col-xs-12 col-md-3 itemToBillingAddress-<?= $model['addressId'] ?>">
    <div class="panel panel-default">
        <div class="size8" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
        <div class="panel-body">
            <div class="row size14">
                <div class="col-md-3 col-sm-3">Name:</div>
                <div class="col-md-9 col-sm-9"><?= $model['firstname'] ?> <?= $model['lastname'] ?></div>
                <div class="col-md-3 col-sm-3">Address:</div>
                <div class="col-md-9 col-sm-9"><?= $model['address'] ?>, <?= $model['district'] ?> <?= $model['amphur'] ?> <?= $model['province'] ?> , <?= $model['country'] ?> <?= $model['zipcode'] ?>
                </div>
                <div class="col-md-12 text-right">
                    <div class="size10">&nbsp;</div>
                    <!--<a href="#" class="text-warning"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</a>-->
                    <?= \yii\bootstrap\Html::a('<i class="fa fa-pencil-square-o"></i>&nbsp;Edit', \yii\helpers\Url::to(['my-account/edit-billing/' . \common\models\ModelMaster::encodeParams(['addressId' => $model['addressId']])]), ['class' => 'text-warning']) ?>
                    <a href="javascript:deleteItemToBillingAddressMe(<?= $model['addressId'] ?>);" id="deleteItemToBillingAddressz-<?= $model['addressId'] ?>" data-loading-text="<a><i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i></a>"  class=" text-danger"><i class="fa fa-trash-o"></i>&nbsp;Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>

