<div class="col-md-12 col-sm-6 col-xs-6">
    <?php
    if ($index == 0) {
        echo '<div class="text-head-site">GOOD READS</div>';
    }
    ?>

    <div class="product-other">
        <a href="<?php echo $model['url']; ?>">
            <img src="<?php echo $model['image']; ?>" alt="Other Product" class="fullwidth  img-responsive" style="width: : 100%;">
        </a>
    </div>
</div>