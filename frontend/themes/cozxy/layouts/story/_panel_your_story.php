<div class="panel panel-defailt">
    <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
    <h3 class="page-header" style="margin:10px 20px;">
        MY STORY
        <p class="size14 size14-xs" style="margin-top: 8px;float: right;">
            <a href="" data-toggle="modal" data-target="#StoryModal">What's this?</a>

        </p>
    </h3>

    <div class="panel-body text-center">
        <?php if ($StoryProductPost->allModels['myStoryTop']['title'] != NULL) { ?>
            <a href="<?= $StoryProductPost->allModels['myStoryTop']['urlView']; ?>">
                <?php /*
                  <img src="<?php echo $StoryProductPost->allModels['myStoryTop']['image']; ?>" class="img-circle" alt="" style="width:120px;">
                 */ ?>

                <img src="<?php echo $productViews['image']; ?>" class="img-circle img-responsive" alt="" style="width:120px;">
            </a>
        <?php } else { ?>
            <?php /*
              <img src="<?php echo $StoryProductPost->allModels['myStoryTop']['image']; ?>" class="img-circle" alt="" style="width:120px;">
             */ ?>
            <img src="<?php echo $productViews['image']; ?>" class="img-circle img-responsive" alt="" style="width:120px;">

        <?php } ?>
        <h4><span style="height: 50px;"></span><?php echo $StoryProductPost->allModels['myStoryTop']['title']; ?></h4>
        <?php if ($StoryProductPost->allModels['myStoryTop']['title'] == NULL) {//user นี้เคยเขียนโพสให้กับ สินค้านี้แล้ว ?>
            <a href="<?php echo $StoryProductPost->allModels['myStoryTop']['url']; ?>" class="b btn-g999" style="margin:24px auto 12px"><?php echo $StoryProductPost->allModels['myStoryTop']['text']; ?></a>

        <?php } ?>
    </div>
</div>
<div class="modal fade" id="StoryModal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeWishlistModal"><i class="fa fa-times"></i>
                </button>
                <h3>MY STORY</h3>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <?= common\helpers\Faq::Faqs('My Story') ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>