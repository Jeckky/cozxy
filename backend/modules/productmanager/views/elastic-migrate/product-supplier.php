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
$url = Elastic::getElasticUrl();
$i=0;
?>

<?php foreach($productModels as $productModel): ?>
    <p>
        <?php
        $productId = $productModel['productId'];
        settype($productId, 'int');
        unset($productModel['productId']);
        $productSuppId = $productModel['productSuppId'];
        settype($productSuppId, 'int');
        unset($productModel['productSuppId']);


        settype($productModel['status'], 'int');
        settype($productModel['result'], 'int');
        settype($productModel['price'], 'float');

//        Elastic::connect($url.'products/' . $productId . '/suppliers/' . $productSuppId, $productModel, Elastic::METHOD_PUT);

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
