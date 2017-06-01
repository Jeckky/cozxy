<div class="container login-box">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <div class="col-xs-12 bg-yellow1 b" style="padding:18px 18px 10px;">
            <p class="size20 size18-xs">About</p>
        </div>
        <div class="col-xs-12 bg-white size18 b" style="padding: 20px;">
            <?php foreach ($content as $detail): ?>
                <div class="col-xs-12 bg-white size18 b" style="padding: 20px;border: #cccccc thin solid;margin-bottom: 10px;border-radius: 20px 20px 20px 20px;">
                    <h3><?= $detail->title ?></h3>
                    <?= $detail->description ?>
                </div>
            <?php endforeach;
            ?>
        </div>
    </div>
</div>

<div class="size32">&nbsp;</div>