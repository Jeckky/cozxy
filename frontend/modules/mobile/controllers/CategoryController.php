<?php

namespace frontend\modules\mobile\controllers;

use common\models\costfit\Category;
use yii\helpers\Json;

class CategoryController extends \common\controllers\MasterController
{
	public function actionIndex()
	{
//		if (isset($_SERVER['HTTP_ORIGIN'])) {
//			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//			header('Access-Control-Allow-Credentials: true');
//			header('Access-Control-Max-Age: 86400');    // cache for 1 day
//		}

		$categories = [];
		$cats = Category::find()->where(['parentId' => NULL])->orderBy('title')->all();

		$i = 0;
		foreach($cats as $cat)
		{
			$categories[$i]['name'] = $cat->title;
			$categories[$i]['id'] = Category::encodeParams(['categoryId'=>$cat->categoryId]);
			$categories[$i]['url'] = Category::encodeParams(['categoryId'=>$cat->categoryId]);

			if($cat->childs !== [])
			{
				$categories[$i]['items'] = [];
				//first child
				$j = 0;
				foreach($cat->childs as $subCat)
				{
					$categories[$i]['items'][$j]['name'] = $subCat->title;
					$categories[$i]['items'][$j]['id'] = Category::encodeParams(['categoryId'=>$subCat->categoryId]);
					$categories[$i]['items'][$j]['url'] = Category::encodeParams(['categoryId'=>$subCat->categoryId]);

					if($subCat->childs !== [])
					{
						$categories[$i]['items'][$j]['items'] = [];
						$k = 0;
						foreach($subCat->childs as $subCat2)
						{
							$categories[$i]['items'][$j]['items'][$k]['name'] = $subCat2->title;
							$categories[$i]['items'][$j]['items'][$k]['id'] = Category::encodeParams(['categoryId'=>$subCat2->categoryId]);;
							$categories[$i]['items'][$j]['items'][$k]['url'] = Category::encodeParams(['categoryId'=>$subCat2->categoryId]);;

							$k++;
						}
					}
					$j++;
				}
			}

			$i++;
		}
		$this->writeToFile('/tmp/categories', print_r($categories, true));
		header('Content-type: text/json');
		echo Json::encode($categories);
	}

}
