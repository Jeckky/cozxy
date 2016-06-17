<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreProduct;
    use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* StoreProductController implements the CRUD actions for StoreProduct model.
*/
class StoreProductController extends BackendMasterController
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
* Lists all StoreProduct models.
* @return mixed
*/
public function actionIndex()
{
    $dataProvider = new ActiveDataProvider([
    'query' => StoreProduct::find(),
    ]);

    return $this->render('index', [
    'dataProvider' => $dataProvider,
    ]);
}

/**
* Displays a single StoreProduct model.
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
* Creates a new StoreProduct model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new StoreProduct();
if(isset($_POST["StoreProduct"]))
{
$model->attributes = $_POST["StoreProduct"];
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
* Updates an existing StoreProduct model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param string $id
* @return mixed
*/
public function actionUpdate($id)
{
$model = $this->findModel($id);
if(isset($_POST["StoreProduct"]))
{
$model->attributes = $_POST["StoreProduct"];
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
* Deletes an existing StoreProduct model.
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
* Finds the StoreProduct model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param string $id
* @return StoreProduct the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel($id)
{
if (($model = StoreProduct::findOne($id)) !== null) {
return $model;
} else {
throw new NotFoundHttpException('The requested page does not exist.');
}
}
}
