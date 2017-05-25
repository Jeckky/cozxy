<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\select2\Select2;

?>

<style>
    .write-story-banner {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .write-story-banner img {
        position: absolute;
        left: -100%;
        right: -100%;
        top: -100%;
        bottom: -100%;
        margin: auto;
        height: auto;
        width: auto;
    }
</style>

<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-white">
            <h1 class="page-header">
                <p style="margin: 0px;" class="size20 fc-g999">
                    Freitag
                </p>
                Lorem ipsum dolor sit amet
            </h1>

            <div class="write-story-banner">
                <?= Html::img(Url::home() . 'images/content/freitag1.jpg', ['class' => 'img-responsive']) ?>
            </div>

            <div class="size12 size10-xs">&nbsp;</div>

            <?= Select2::widget([
                'name' => 'shelf',
                'value' => '',
                'data' => ['Shelf', 'Shelf2', 'Shelf3'],
                'options' => ['placeholder' => 'Select Shelf']
            ]) ?>

            <div class="size12 size10-xs">&nbsp;</div>

            <?php
            /**
             * Editor
             */
            ?>
            <textarea name="" id="" cols="30" rows="14" style="width: 100%;"></textarea>

            <div class="size12 size10-xs">&nbsp;</div>

            <div class="panel panel-default">
                <div class="panel-heading">Compare Price</div>
                <div class="panel-body login-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Shop Name</label>
                                <input type="text" name="firstname" class="fullwidth" placeholder="Shop Name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" name="lastname" class="fullwidth" placeholder="Price" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country</label>
                                        <?= Select2::widget([
                                            'name' => 'country',
                                            'value' => '',
                                            'data' => ['Country', 'Country2', 'Country3'],
                                            'options' => ['placeholder' => 'Select Country']
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Currency</label>
                                        <?= Select2::widget([
                                            'name' => 'currency',
                                            'value' => '',
                                            'data' => ['Currency', 'Currency2', 'Currency3'],
                                            'options' => ['placeholder' => 'Select Currency']
                                        ]) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Shop Name</label>
                                <input type="file" name="firstname" class="fullwidth" placeholder="Shop Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Location (Lat,Long)</label>
                                        <input type="text" name="firstname" class="fullwidth" placeholder="Location (Lat,Long)" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d124008.92046473033!2d100.48062576799724!3d13.762055508253102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x30e29ebe74b07b57%3A0x1892d37c43ed15a7!2z4LiV4Lil4Liy4LiU4Lio4Lij4Li14LiU4Li04LiZ4LmB4LiU4LiH!3m2!1d13.7620654!2d100.55066629999999!5e0!3m2!1sth!2sth!4v1494639156559" frameborder="0" style="width:100%;height:20vh;border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <input type="checkbox"> Make public
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn-yellow">Save Story</button>
                </div>
            </div>
            <div class="size12 size10-xs">&nbsp;</div>
        </div>

    </div>

    <div class="size12 size10-xs">&nbsp;</div>
</div>