<div class="row">
    <div class="col-lg-7">
        <div class="row">
            <div class="col-lg-12">
                <img src="<?= Yii::$app->homeUrl . $model->productImages[0]->image ?>" style="width:100%">
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($model->productImages as $img):
                ?>
                <div class="col-lg-2">
                    <img src="<?= Yii::$app->homeUrl . $img->image ?>" style="width:100%">
                </div>

                <?php
            endforeach;
            ?>
        </div>
    </div>
    <div class="col-lg-5">
        <h2><?= $model->title ?></h2>
        <p><?= isset($model->brand) ? "<span style='color: #00CCFF'> by </span>" . $model->brand->title : "" ?></p>
        <h3><i class="glyphicon glyphicon-plane "></i> FREE Shipping</h3>
        <h2>$ <?= isset($model->productOnePrice) ? $model->productOnePrice->price : "0"; ?></h2>
        <h3><i class="glyphicon glyphicon-certificate " style="color: #00CCFF"></i> FREE Shipping</h3>
        <p>
            <?//= $model->shortDescription; ?>
            <?php if (count($model->productGroup->products) > 1): ?>
                <select class="form-control">
                    <?php foreach ($model->productGroup->products as $option): ?>
                        <option><?= $option->optionName; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </p>
        <select class="" style="width: 100px">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
        <a class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i>Add To Cart</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
            <li role="presentation"><a href="#specification" aria-controls="profile" role="tab" data-toggle="tab">Specification</a></li>
            <!--            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>-->
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="description">
                <?= $model->description; ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="specification">
                <?= $model->specification; ?>
            </div>
            <!--            <div role="tabpanel" class="tab-pane" id="messages">...</div>
                        <div role="tabpanel" class="tab-pane" id="settings">...</div>-->
        </div>
    </div>
</div>