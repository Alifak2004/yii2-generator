<?php

namespace app\controllers;

use app\models\Users;
use app\models\UsersSearch;
use app\Controllers\SiteController;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;


/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     *
     * @return string
     */
    public function actionIndex($ajax = false)
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if($ajax) {
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
     * Displays a single Users model.
     * @param int $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id)
    {
        if ($this->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($user_id),
                'isAjax' => true,
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($user_id),
            ]);
        }
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($this->request->isAjax) {
            if ($this->request->isGet) {
                $model->loadDefaultValues();
                return $this->renderAjax('create', [
                    'model' => $model,
                    'isAjax' => true,
                    "images" => json_encode([])
                ]);
                // loads all default values in the inputs specified in the database 
            }
            if ($this->request->isPost) {
                // imageData
                $imageData = Yii::$app->request->post()["imageData"];
                $imageData = explode(",", $imageData);

                $res = [];
                if ($model->load($this->request->post()) && $model->save()) {
                    $imageData = Yii::$app->request->post()["imageData"];
                    $imageData = explode(",", $imageData);
                    $uploadDir = Yii::$app->params['physical_path'] . "/uploads" . "/1" . "/" . $model->user_id . "/";

                    if (!empty($imageData)) {
                        foreach ($imageData as $index => $imageBase64) {
                            if (empty($imageBase64)) {
                                continue;
                            }
                            // Generate a unique file name for each image
                            $fileName = date('Y-m-d-H-i-s') . '__' . $index . '.png';


                            // Decode the base64 image data
                            $imageData = base64_decode($imageBase64);

                            // make sure the directory is there
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0777, true);
                            }
                            // Save the image to the upload directory
                            file_put_contents($uploadDir . $fileName, $imageData);
                            Yii::warning($uploadDir . $fileName);
                            $model->image_url = $uploadDir . $fileName;
                            // Optionally, you can also create an ActiveRecord model and save the image information to a database
                            // $model = new YourImageModel();
                            // $model->filename = $fileName;
                            // $model->save();
                        }
                        $model->save();
                    }
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
        } else {

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'user_id' => $model->user_id]);
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

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $user_id User ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id)
    {
        $model = $this->findModel($user_id);
        if ($this->request->isAjax) {
            if ($this->request->isGet) {
                // $uploadDir = Yii::$app->params['physical_path'] . "/uploads" . "/1" . "/" . $model->user_id . "/";
                // // make sure the directory is there
                // $images = [];
                // // load images
                // if (!is_dir($uploadDir)) {
                //     mkdir($uploadDir, 0777, true);
                // } else {
                //     // delete the photo that was there before this one
                //     $files = glob($uploadDir . '/*'); // Get list of file paths in the directory
                //     foreach ($files as $index => $file) {
                //         Yii::warning($file);
                //         if (is_file($file)) {
                //             $imageContents = file_get_contents($file); // Read the file contents
                //             $filename = basename($file); // Get the filename from the file path

                //             $imageBase64 = base64_encode($imageContents); // Encode the contents to base64
                //             $images[$index] = []; // Create an empty array for the index if it doesn't exist
                //             $images[$index]["dir"] = $uploadDir;
                //             $images[$index]["url"] =  Yii::$app->params["base_path"] . "/uploads" . "/1" . "/" . $model->user_id . "/" . $filename;
                //             $images[$index]["base64"] = $imageBase64;
                //             // Use the $imageBase64 as needed, such as storing it in a database or sending it in a response
                //         }
                //     }
                // }
                

                $images = SiteController::AfGetImage($model->user_id, 1);
                // ----- image laoding ends here (if no image in model remove code)

                return $this->renderAjax('update', [
                    'model' => $model,
                    'isAjax' => true,
                    "images" => json_encode($images)
                ]);
            }
            if ($this->request->isPost) {
                $imageData = Yii::$app->request->post()["imageData"];
                $imageData = explode(",", $imageData);

                $res = [];

                // single image
                if ($model->load($this->request->post()) && $model->save()) {
                    $imageData = Yii::$app->request->post()["imageData"];
                    // $imageData = explode(",", $imageData);
                    // $uploadDir = Yii::$app->params['physical_path'] . "/uploads" . "/1" . "/" . $model->user_id . "/";
                    // $uploadDir_localhost = Yii::$app->params["base_path"] . "/uploads" . "/1" . "/" . $model->user_id . "/";
                    // if (!empty($imageData)) {
                    //     Yii::warning("NOT EMPTY");
                    //     Yii::warning($imageData);
                    //     // make sure the directory is there
                    //     if (!is_dir($uploadDir)) {
                    //         mkdir($uploadDir, 0777, true);
                    //     } else {
                    //         // delete the photo that was there before this one
                    //         $files = glob($uploadDir . '/*'); // Get list of file paths in the directory
                    //         foreach ($files as $file) {
                    //             if (is_file($file)) {
                    //                 unlink($file); // Delete the file
                    //             }
                    //         }
                    //     }
                    //     foreach ($imageData as $index => $imageBase64) {
                    //         if (empty($imageBase64)) {
                    //             continue;
                    //         }
                    //         // Generate a unique file name for each image
                    //         $fileName = date('Y-m-d-H-i-s') . '__' . $index . '.png';


                    //         // Decode the base64 image data
                    //         $imageData = base64_decode($imageBase64);


                    //         // Save the image to the upload directory
                    //         file_put_contents($uploadDir . $fileName, $imageData);
                    //         $model->image_url = $uploadDir_localhost . $fileName;
                    //         // Optionally, you can also create an ActiveRecord model and save the image information to a database
                    //         // MULTIPLE IMAGES ADD THEM IN SEPERATE TABLE CALLED af_images create a new row each time with table_id , its primary keys id , the url and created_at
                    //         // $model = new YourImageModel();
                    //         // $model->filename = $fileName;
                    //         // $model->save();
                    //     }
                    //     $model->save();
                    // } else {
                    //     $files = glob($uploadDir . '/*'); // Get list of file paths in the directory
                    //     foreach ($files as $file) {
                    //         if (is_file($file)) {
                    //             unlink($file); // Delete the file
                    //         }
                    //     }
                    // }
                    $model  = SiteController::AfPostImages($model->user_id, 1, $model,$imageData );
                    $res["finish"] = true;
                    return json_encode($res);
                    // return $this->redirect(['view', 'user_id' => $model->user_id]);
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
        } else {

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'user_id' => $model->user_id]);
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
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $user_id User ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id)
    {
        $uploadDir = Yii::$app->params['physical_path'] . "/uploads" . "/1" . "/" . $user_id . "/";
        if (is_dir($uploadDir)) {
            $files = glob($uploadDir . '*'); // Get all files and directories within the directory
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Delete files within the directory
                }
                // elseif (is_dir($file)) {
                //     // Recursively delete subdirectories and their contents
                //     $subFiles = glob($file . '/*');
                //     foreach ($subFiles as $subFile) {
                //         unlink($subFile);
                //     }
                //     rmdir($file);
                // }
            }

            rmdir($uploadDir);
        }
        if (Yii::$app->request->isDelete) {
            $this->findModel($user_id)->delete();
            return 1;
        }

        // return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $user_id User ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id)
    {
        if (($model = Users::findOne(['user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
