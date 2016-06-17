<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\Region;
    use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* RegionController implements the CRUD actions for Region model.
*/
class RegionController extends BackendMasterController
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
* Lists all Region models.
* @return mixed
*/
public function actionIndex()
{
    $dataProvider = new ActiveDataProvider([
    'query' => Region::find(),
    ]);

    return $this->render('index', [
    'dataProvider' => $dataProvider,
    ]);
}

/**
* Displays a single Region model.
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
* Creates a new Region model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new Region();
if(isset($_POST["Region"]))
{
$model->attributes = $_POST["Region"];
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
* Updates an existing Region model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param string $id
* @return mixed
*/
public function actionUpdate($id)
{
$model = $this->findModel($id);
if(isset($_POST["Region"]))
{
$model->attributes = $_POST["Region"];
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
* Deletes an existing Region model.
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
* Finds the Region model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param string $id
* @return Region the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel($id)
{
if (($model = Region::findOne($id)) !== null) {
return $model;
} else {
throw new NotFoundHttpException('The requested page does not exist.');
}
}
}
