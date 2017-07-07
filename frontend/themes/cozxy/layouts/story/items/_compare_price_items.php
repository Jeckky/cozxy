<tr id="compare-price-<?= $model['comparePriceId'] ?>">
    <td><?= ++$index ?></td>
    <td><?= $model['country']; ?></td>
    <td><?= $model['place']; ?></td>
    <td><?= $model['price']; ?></td>
    <td>
        <?= $model['LocalPrice']; ?>
        <?php
        if (Yii::$app->user->id == $model['userId']) {
            ?>
            &nbsp;<code><a class="text-danger"  onclick="CozxyComparePriceModernBest(<?= $model['comparePriceId'] ?>, 'edit',<?= $index ?>)"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit Price</a></code>
        <?php } ?>
    </td>
</tr>
<!--bs-example-modal-lg-x" data-id="<?//= $model['productPostId'] ?>"-->