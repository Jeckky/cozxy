<tr id="compare-price-<?= $model['productPostId'] ?>">
    <td><?= ++$index ?></td>
    <td><?= $model['country']; ?></td>
    <td><?= $model['place']; ?></td>
    <td><?= $model['price']; ?></td>
    <td>
        <?= $model['LocalPrice']; ?>
        <?php
        if (Yii::$app->user->id == $model['userId']) {
            ?>
            &nbsp;<code><a class="text-danger" onclick="bsExampleModalLgX(<?= $model['productPostId'] ?>, 'edit')"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit Price</a></code>
        <?php } ?>
    </td>
</tr>
<!--bs-example-modal-lg-x" data-id="<?//= $model['productPostId'] ?>"-->