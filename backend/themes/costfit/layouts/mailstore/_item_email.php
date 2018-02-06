<li class="mail-item">
    <div class="m-chck"><label class="px-single"><input type="checkbox" name="" value="" class="px"><span class="lbl"></span></label></div>
    <div class="m-star"><a href="#"></a></div>
    <div class="m-from"><a href="#">ยังไม่ยืนยันเมล์</a></div>
    <div class="m-subject">
        <?php
        $typeWeb = $model->password;
        if (isset($model->auth_type)) {
            ?>
            <span class="label label-warning"><?= $model->auth_type ?></span>
        <?php } else { ?>
            <?php
            if (isset($typeWeb)) {
                ?>
                <span class="label label-pa-purple">Web&nbsp;(Booth)</span>
            <?php } else { ?>
                <span class="label label-pa-danger">Web&nbsp;</span>
            <?php } ?>
        <?php } ?> &nbsp;&nbsp;
        <a href="#">(<?= $model->username ?>)&nbsp;<?= $model->firstname ?> <?= $model->lastname ?></a></div>
    <div class="m-date"><?= $model->createDateTime ?></div>
</li>
