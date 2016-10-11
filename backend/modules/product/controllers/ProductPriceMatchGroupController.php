<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductPriceMatchGroup;
    use yii\data\ActiveDataProvider;
use backend\modules\product\controllers\ProductMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* ProductPriceMatchGroupController implements the CRUD actions for ProductPriceMatchGroup model.
*/
class ProductPriceMatchGroupController extends ProductMasterController
{
public function behaviors()
{
return [
'verbs' => [
'class' => VerbFilter::className(),
'actions' => [
'delete' => ['post'],
],
],
];
}

/**
* Lists all ProductPriceMatchGroup models.
* @return mixed
*/
public function actionIndex()
{
    $dataProvider = new ActiveDataProvider([
    'query' => ProductPriceMatchGroup::find(),
    ]);

    return $this->render('index', [
    'dataProvider' => $dataProvider,
    ]);
}

/**
* Displays a single ProductPriceMatchGroup model.
* @param string $id
* @return mixed
*/
public function actionView($id)
{
return $this->render('view', [
'model' => $this->findModel($id),
]);
}

/**
* Creates a new ProductPriceMatchGroup model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new ProductPriceMatchGroup();
if(isset($_POST["ProductPriceMatchGroup"]))
{
$model->attributes = $_POST["ProductPriceMatchGroup"];
$model->createDateTime = new \yii\db\Expression('NOW()');
if ($model->save()) {
return $this->redirect(['index']);
}
}
return $this->render('create', [
'model' => $model,
]);

}

/**
* Updates an existing ProductPriceMatchGroup model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param string $id
* @return mixed
*/
public function actionUpdate($id)
{
$model = $this->findModel($id);
if(isset($_POST["ProductPriceMatchGroup"]))
{
$model->attributes = $_POST["ProductPriceMatchGroup"];
$model->updateDateTime = new \yii\db\Expression('NOW()');



if ($model->save()) {
return $this->redirect(['index']);
}
}
return $this->render('update', [
'model' => $model,
]);

}

/**
* Deletes an existing ProductPriceMatchGroup model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param string $id
* @return mixed
*/
public function actionDelete($id)
{
$this->findModel($id)->delete();

return $this->redirect(['index']);
}

/**
* Finds the ProductPriceMatchGroup model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param string $id
* @return ProductPriceMatchGroup the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel($id)
{
if (($model = ProductPriceMatchGroup::findOne($id)) !== null) {
return $model;
} else {
throw new NotFoundHttpException('The requested page does not exist.');
}
}
}
