<div class="panel panel-defailt">
    <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
    <h3 class="page-header" style="margin:10px 20px;">My Story</h3>
    <div class="panel-body text-center">
        <?php // throw new \yii\base\Exception(print_r($model, true)); ?>
        <?php if ($model['title'] != NULL) { ?>
            <a href="<?= $model['urlView']; ?>">
                <img src="<?php echo $model['image']; ?>" class="img-circle" alt="" style="width:120px;">
            </a>
            <?php } else{ ?>
            <img src="<?php echo $model['image']; ?>" class="img-circle" alt="" style="width:120px;">

            <?php } ?>
            <h4><span style="height: 50px;"></span><?php echo $model['title']; ?></h4>
            <?php if ($model['title'] == NULL) {//user นี้เคยเขียนโพสให้กับ สินค้านี้แล้ว ?>
                <a href="<?php echo $model['url']; ?>" class="b btn-g999" style="margin:24px auto 12px"><?php echo $model['text']; ?></a>
            <?php } ?>
    </div>
</div>