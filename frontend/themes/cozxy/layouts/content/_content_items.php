
<?php
if ($index == 0) {
    echo '<div class="text-center">
    <p><div class="btn-default btn size14-xs text text-head-site btn-good-reads">GOOD READS</div></p>
</div>';
}
?>


<div class="">
    <a href="<?php echo $model['url']; ?>">
        <img src="<?php echo $model['image']; ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%;">
    </a>
    <p class="name">
        <a href="<?php echo $model['url']; ?>" class="size18 b fc-black" target="_bank"><?= $model['title'] ?></a>
    <hr>
    </p>
</div>
<?php
if ($index == 1) {
    ?>
    <div class="col-sm-12 text-center" style="margin-bottom: 20px;">
        <a href="<?= Yii::$app->homeUrl ?>" class="subs-btn size14-xs">VIEW ALL</a>
    </div>
    <br><br>
    <?php
} elseif ($index == 2) {
    ?>
    <div class="col-sm-12 text-center" style="margin-bottom: 20px;">
        <a href="<?= Yii::$app->homeUrl ?>" class="subs-btn size14-xs">VIEW ALL</a>
    </div>
    <br><br>
    <?php
}?>