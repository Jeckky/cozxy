<?php

namespace frontend\modules\mobile\controllers;

use common\models\costfit\Category;
use common\models\costfit\CategoryToProduct;
use common\models\ModelMaster;
use yii\base\Model;
use yii\helpers\Json;

class ProductController extends \common\controllers\MasterController
{
	public function actionIndex($hash)
	{
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}

		$params = ModelMaster::decodeParams($hash);

		$ctps = CategoryToProduct::find()
			->where(['category_to_product.categoryId'=>$params['categoryId']])
			->joinWith(['product'])
			->orderBy('product.title')
			->all();

		$ps  = [];

		$i = 0;
		foreach($ctps as $ctp)
		{
			if(!isset($ctp->product)) continue;

			$ps[$i]['title'] = $ctp->product->title;
			$ps[$i]['isbn'] = $ctp->product->isbn;
			$ps[$i]['code'] = $ctp->product->code;
			$ps[$i]['shortDescription'] = $ctp->product->shortDescription;
			$ps[$i]['description'] = $ctp->product->description;
			$ps[$i]['specification'] = $ctp->product->specification;
			$ps[$i]['width'] = $ctp->product->width;
			$ps[$i]['height'] = $ctp->product->height;
			$ps[$i]['depth'] = $ctp->product->depth;
			$ps[$i]['weight'] = $ctp->product->weight;
			$ps[$i]['price'] = $ctp->product->price;
			$ps[$i]['brand'] = $ctp->product->brand->title;

			$hash = [
				'categoryId'=>$ctp->categoryId,
				'productId'=>$ctp->productId,
				'brandId'=>$ctp->product->brandId,
			];

			$ps[$i]['hash'] = ModelMaster::encodeParams($hash);

			//product images
			$j=0;
			foreach($ctp->product->productImages as $pi) {
				$ps[$i]['images'][$j] = [
					'url' => $pi->image,
					'urlTn1' => $pi->imageThumbnail1,
					'urlTn2' => $pi->imageThumbnail2,
				];
				$j++;
			}

			$i++;
		}

		print_r(Json::encode($ps));
	}

	public function actionProduct($hash)
	{
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}

		$params = ModelMaster::decodeParams($hash);
	}

}
