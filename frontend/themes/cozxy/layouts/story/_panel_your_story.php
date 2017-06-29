<div class="panel panel-defailt">
    <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
    <h3 class="page-header" style="margin:10px 20px;">My Story</h3>
    <div class="panel-body text-center"> 
        <?php if ($StoryProductPost->allModels['myStoryTop']['title'] != NULL) { ?>
            <a href="<?= $StoryProductPost->allModels['myStoryTop']['urlView']; ?>">
                <img src="<?php echo $StoryProductPost->allModels['myStoryTop']['image']; ?>" class="img-circle" alt="" style="width:120px;">
            </a>
        <?php } else { ?>
            <img src="<?php echo $StoryProductPost->allModels['myStoryTop']['image']; ?>" class="img-circle" alt="" style="width:120px;">

        <?php } ?>
        <h4><span style="height: 50px;"></span><?php echo $StoryProductPost->allModels['myStoryTop']['title']; ?></h4>
        <?php if ($StoryProductPost->allModels['myStoryTop']['title'] == NULL) {//user นี้เคยเขียนโพสให้กับ สินค้านี้แล้ว ?>
            <a href="<?php echo $StoryProductPost->allModels['myStoryTop']['url']; ?>" class="b btn-g999" style="margin:24px auto 12px"><?php echo $StoryProductPost->allModels['myStoryTop']['text']; ?></a>
        <?php } ?>
    </div>
</div>