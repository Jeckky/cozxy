<?php
if (isset($_GET['act'])) {
    $show = $_GET['act'];
} else {
    $show = 0;
}
$i = 1;
?>
<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">FAQS</p>
        </div>
        <div class="col-xs-12 bg-white b" style="padding:18px 18px 10px;">
            <?php foreach ($content as $detail): ?>
                <div class="col-xs-12 bg-warning size18 b" data-toggle="collapse" data-target="#faq<?= $detail->contentId ?>"style="border: #cccccc thin solid;margin-top: 10px;margin-bottom: 10px;cursor: pointer;">
                    <h3><?= $detail->title ?></h3>
                </div>
                <div class="col-xs-12 bg-white size18 b collapse <?= $show == $detail->contentId ? 'in' : '' ?><?= $show == 0 && $i == 1 ? 'in' : '' ?>" id="faq<?= $detail->contentId ?>"style="padding: 20px;border: #cccccc thin solid;margin-bottom: 10px;border-radius: 20px 20px 20px 20px;">
                    <?= $detail->description ?>
                </div>
                <?php
                $i++;
            endforeach;
            ?>
        </div>
    </div>
</div>
<div class="size32">&nbsp;</div>