<?php
function product($id, $img, $txt, $txt_d, $price, $price_s, $url) {
    echo '
		<div class="col-md-3 col-sm-6">
			<div class="product-box">
				<div class="product-img text-center">
					<a href="'.$url.'"><img src="'.$img.'" alt="'.$txt_d.'" class="fullwidth"></a>
				</div>
				<div class="product-txt">
					<p class="size16"><a href="'.$url.'" class="fc-black">'.$txt_d.'</a></p>
					<p>
						<span class="size18">'.$price.'</span> &nbsp;
						<span class="size14 onsale">'.$price_s.'</span>
					</p>
					<p class="size14 fc-g999">'.$txt.'</p>
					<p><a href="cart.php" class="btn-yellow">ADD TO CART</a> &nbsp; <a href="#" class="fc-g999">REMOVE</a></p>
				</div>
			</div>
		</div>
	';
}
?>

<div class="row">
    <?php
    product('01', 'imgs/product01.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    product('02', 'imgs/product07.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    product('03', 'imgs/product03.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    product('04', 'imgs/product04.jpg', 'PREMIUM BAG', 'QUILTED NAPPA GANSEVOORT FLAP SHOULDER BAG', '43,000 THB', '59,000 THB', 'product-view.php');
    ?>
</div>