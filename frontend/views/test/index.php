<div class="col-sm-12">
    <?php
    foreach ($this->params['actionTreeSub'] as $key => $value) {
        //echo common\models\ModelMaster::createTitleArray($value['title']);
        ?>
        <div class="sub-item-<?= $value['categoryId'] ?>">
            <?php
            if (isset($value['Children'])) {
                //echo 'count :' . count($value['Children']);
                foreach ($value['Children'] as $key => $items) {
                    ?>
                    <div class="sub-cate"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($items['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $items['categoryId']]) ?>"><?= $items['title'] ?></a></div>
                    <?php
                    if (isset($items['Children'])) {
                        ?>
                        <div class="row sub-items">
                            <?php
                            foreach ($items['Children'] as $key => $sub) {
                                ?>
                                <div class="col-md-4"><a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($sub['title']) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $sub['categoryId']]) ?>" class="fc-yellow2">– <?= $sub['title'] ?></a></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>

</div>