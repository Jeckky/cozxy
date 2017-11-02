
<?php
if ($index == 0) {
    echo '<div class="text-center">
    <p><div class="btn-default btn size14-xs text text-head-site">GOOD READS</div></p>
</div>';
}
?>


<div class="">
    <a href="<?php echo $model['url']; ?>">
        <img src="<?php echo $model['image']; ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: 100%;">
    </a>
    <p class="name">
        <a href="<?php echo $model['url']; ?>" class="size18 b fc-black"><?= $model['title'] ?></a>
    <hr>
    </p>
    <p class="name"></p>
</div>