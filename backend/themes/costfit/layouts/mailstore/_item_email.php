<li class="mail-item">
    <div class="m-chck">
        <label class="px-single">
            <input type="checkbox" name="user[<?= $model->userId ?>]" value="<?= $model->email ?>" class="px" id="user<?= $model->userId ?>">
            <span class="lbl"></span>
        </label>
    </div>
    <div class="m-star"><a href="#"></a></div>
    <div class="m-from"><a href="#">ยังไม่ยืนยัน email</a></div>
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
        <a href="#">(<?= $model->username ?>)&nbsp;<?= $model->firstname ?> <?= $model->lastname ?></a>
        <span class="label label-danger"><?= !isset($model->password) ? 'password not set' : '' ?></span>
    </div>
    <div class="m-date"><?= $model->createDateTime ?></div>
</li>
