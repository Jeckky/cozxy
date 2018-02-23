<?php
/* @var $this yii\web\View */

use backend\modules\elasticsearch\models\Elastic;

?>
<h1>create-product-image/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<p>
    <?= sizeof($productModels) ?> products
</p>

<p><?= $diffTime ?> sec.</p>

<hr>

<?php
$time = explode(' ', microtime());
$startTime = $time[0] + $time[1];
$i = 0;
?>

<?php foreach($productModels as $productModel): ?>
    <p>
        <?php
        settype($productModel['productId'], 'int');
        settype($productModel['parentId'], 'int');
        settype($productModel['status'], 'int');
        settype($productModel['brandId'], 'int');
        settype($productModel['categoryId'], 'int');
        settype($productModel['price'], 'float');
        settype($productModel['productGroupTemplateId'], 'int');

        $createDateTime = explode(' ', $productModel['createDateTime']);
        $productModel['createDateTime'] = $createDateTime[0] . 'T' . $createDateTime[1] . '.000Z';

        $updateDateTime = explode(' ', $productModel['updateDateTime']);
        $productModel['updateDateTime'] = $updateDateTime[0] . 'T' . $updateDateTime[1] . '.000Z';

        Elastic::updateProduct($productModel['productId'], $productModel);

        var_dump($productModel);
        $i++;
        ?>
    </p>
<?php endforeach; ?>
<hr>
<p>
    <?php
    $time = explode(' ', microtime());
    $endTime = $time[0] + $time[1];
    echo $endTime - $startTime;
    ?>
</p>

<p><?=$i?> rows</p>
