<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use Yii;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' means authenticated users
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['site/login']);
                },
            ],
        ];
    }

    /**
     * Lists all Products models.
     *
     * @return string
     */

    public function actionIndex($limit = 15, $ajax = false)
    {
        $searchModel = new ProductsSearch();
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
     * Displays a single Products model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $ajax = false)
    {
        if ($ajax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($subMenu = false, $ajax = false)
    {
        $model = new Products();

        if ($this->request->isAjax) {
            if ($this->request->isGet) {
                $model->loadDefaultValues();
                return $this->renderAjax('create', [
                    'model' => $model,
                    'isAjax' => true,
                    "images" => json_encode([]),
                    "subMenu" => $subMenu

                ]);
            }

            if ($this->request->isPost) {
                $imageData = Yii::$app->request->post()["imageData"];

                // imageData
                // before saving put images in temp folder then save in actual folder
                $images  = SiteController::AfPostImages("temp", 2, $model,$imageData );
                $res = [];
                if ($model->load($this->request->post()) && $model->save()) {
                    $images  = SiteController::AfPostImages($model->id, 2, $model,$imageData );
                    $model = $images["model"];
                    $res["finish"] = true;

                    return json_encode($res);
                } else {
                    $res["finish"] = false;
                    $res["html"] = $this->renderAjax('_form_inputs', [
                        "res" => $res,
                        'model' => $model,
                        'isAjax' => true,
                        "images" => json_encode($images),
                        "subMenu" => $subMenu
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
                    "images" => json_encode([]),
                    "subMenu" => $subMenu


                ]);
            }
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $subMenu = false)
    {
        $model = $this->findModel($id);

        if ($this->request->isAjax) {
            
            if ($this->request->isGet) {
                
                $images  = SiteController::AfGetImage($id, 2);
                Yii::warning($images);
                return $this->renderAjax('update', [
                    'model' => $model,
                    'isAjax' => true,
                    "images" => json_encode($images),
                    "subMenu" => $subMenu

                ]);
            }
            if ($this->request->isPost) {
                $imageData = Yii::$app->request->post()["imageData"];
                $images  = SiteController::AfPostImages("temp", 2, $model,$imageData);

                $res = [];

                // single image
                if ($model->load($this->request->post()) && $model->save()) {
                    $images  = SiteController::AfPostImages($model->id, 2, $model,$imageData);
                    $model = $images["model"];
                    
                    $res["finish"] = true;
                    return json_encode($res);
                } else {
                    $res["finish"] = false;
                    $res["html"] = $this->renderAjax('_form_inputs', [
                        "res" => $res,
                        'model' => $model,
                        'isAjax' => true,
                        "images" => json_encode($images),
                        "subMenu" => $subMenu,
                    ]);
                    return json_encode($res);
                }
            }
        } else {

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('update', [
                'model' => $model,
                'isAjax' => false,
                "subMenu" => true
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $uploadDir = Yii::$app->params['physical_path'] . "/uploads" . "/6" . "/" . $id . "/";
        if (is_dir($uploadDir)) {
            $files = glob($uploadDir . '*'); // Get all files and directories within the directory
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Delete files within the directory
                }
            }

            rmdir($uploadDir);
        }

        // $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
