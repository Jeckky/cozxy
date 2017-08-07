<!--$url = \Yii::$app->urlManager->baseUrl . '/images/flags/flags/flat/16/';-->
<tr id="compare-price-<?= $model['comparePriceId'] ?>">
    <td><?= ++$index ?></td>
    <td>
        <div class="col-md-2" style="padding-right: 0cpx; padding-left:0px;">
            <img src="<?= $model['images']; ?>" class="img-responsive">
        </div>
        <div class="col-md-10" style="padding-right: 0cpx; padding-left:0px; margin-left: -15px;"><?= $model['currency_code']; ?> (<?= $model['ccy_name'] ?>)</div>
    </td>
    <td><?= $model['place']; ?></td>
    <td><?php echo $model['currency_code'] . '&nbsp;' . $model['price']; ?></td>
    <td id="local-price-<?= $model['comparePriceId'] ?>">
        <?//= $model['LocalPrice']; ?>-
    </td>
    <td>
        <?php
        if (Yii::$app->user->id == $model['userId']) {
            ?>
            &nbsp;
            <code>
                <a class="text-danger edit-price-<?= $model['comparePriceId'] ?>"  onclick="CozxyComparePriceModernBest(<?= $model['comparePriceId'] ?>, 'edit',<?= $index ?>)">
                    <i class="fa fa-pencil-square-o"></i>&nbsp;<span style="font-size: 11px;">Edit Price</span></a>
            </code>
            <?php
        } else {
            echo '';
        }
        ?>
    </td>
</tr>
<!--bs-example-modal-lg-x" data-id="<?//= $model['productPostId'] ?>"-->