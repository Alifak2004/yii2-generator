<?php

namespace app\controllers;

use app\models\Test;
    use app\models\TestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
* TestController implements the CRUD actions for Test model.
*/
class TestController extends Controller
{
/**
* @inheritDoc
*/
public function behaviors()
{
return array_merge(
parent::behaviors(),
[
'verbs' => [
'class' => VerbFilter::className(),
'actions' => [

],
],
]
);
}

/**
* Lists all Test models.
*
* @return string
*/

public function actionIndex($limit = 15, $ajax = false)
{
    $searchModel = new TestSearch();
    $dataProvider = $searchModel->search($this->request->queryParams, $limit);

    if ($ajax) {
        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    return $this->render('index', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]);
}

/**
* Displays a single Test model.
* @param int $id
* @return string
* @throws NotFoundHttpException if the model cannot be found
*/
public function actionView($id,$ajax = false) {
if($ajax) {
return $this->renderAjax('view', [
'model' => $this->findModel($id),
]);

}
return $this->render('view', [
'model' => $this->findModel($id),
]);
}

/**
* Creates a new Test model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return string|\yii\web\Response
*/
public function actionCreate()
{
$model = new Test();

if ($this->request->isAjax) {
if ($this->request->isGet) {
$model->loadDefaultValues();
return $this->renderAjax('create', [
'model' => $model,
'isAjax' => true,
"images" => json_encode([])
]);
}

if ($this->request->isPost) {

// imageData

$res = [];
if ($model->load($this->request->post()) && $model->save()) {
$res["finish"] = true;

return json_encode($res);
} else {
$res["finish"] = false;
$res["html"] = $this->renderAjax('_form_inputs', [
"res" => $res,
'model' => $model,
'isAjax' => true,
"images" => json_encode([])
]);
return json_encode($res);
}
} else {

if ($this->request->isPost) {
if ($model->load($this->request->post()) && $model->save()) {
return $this->redirect(['view', 'id' => $model->id]);
}
} else {
$model->loadDefaultValues();
}

return $this->render('create', [
'model' => $model,
'isAjax' => false,
"images" => json_encode([])

]);
}
}

}

/**
* Updates an existing Test model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param int $id
* @return string|\yii\web\Response
* @throws NotFoundHttpException if the model cannot be found
*/
public function actionUpdate($id)
{
$model = $this->findModel($id);

if ($this->request->isAjax) {
if ($this->request->isGet) {
$images = [];

return $this->renderAjax('update', [
'model' => $model,
'isAjax' => true,
"images" => json_encode($images)
]);
}
if ($this->request->isPost) {

$res = [];

// single image
if ($model->load($this->request->post()) && $model->save()) {


$res["finish"] = true;
return json_encode($res);
} else {
$res["finish"] = false;
$res["html"] = $this->renderAjax('_form_inputs', [
"res" => $res,
'model' => $model,
'isAjax' => true,
"images" => json_encode([])

]);
return json_encode($res);
}
}
}else {

if ($this->request->isPost) {
if ($model->load($this->request->post()) && $model->save()) {
return $this->redirect(['view', 'id' => $model->id]);
}
} else {
$model->loadDefaultValues();
}

return $this->render('update', [
'model' => $model,
'isAjax' => false
]);
}
}

/**
* Deletes an existing Test model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param int $id
* @return \yii\web\Response
* @throws NotFoundHttpException if the model cannot be found
*/
public function actionDelete($id)
{
$uploadDir = Yii::$app->params['physical_path'] . "/uploads" . "/7" . "/" . $id . "/";
if (is_dir($uploadDir)) {
$files = glob($uploadDir . '*'); // Get all files and directories within the directory
foreach ($files as $file) {
if (is_file($file)) {
unlink($file); // Delete files within the directory
}
}

rmdir($uploadDir);
}

$this->findModel($id)->delete();
return $this->redirect(['index']);
}

/**
* Finds the Test model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param int $id
* @return Test the loaded model
* @throws NotFoundHttpException if the model cannot be found
*/
protected function findModel($id)
{
if (($model = Test::findOne(['id' => $id])) !== null) {
return $model;
}

throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
}
}