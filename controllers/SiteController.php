<?php

namespace app\controllers;

use app\models\AfImages;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;
use app\models\Users;
use yii\db\Query;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionX($ajax = false)
    {
        $connection = Yii::$app->db;
        $query = $connection->createCommand("SELECT * FROM products")->queryAll();
        $productModel = new Products();
        $tableSchema = $productModel->getTableSchema();
        $columns = $tableSchema ? $tableSchema->getColumnNames() : [];

        $data = Products::find()->select(["id", "name", "qty"])->all();
        return $this->render('test', [
            "columns" => $columns,
            "data" => $query
        ]);
        // return $this->render('index');
    }
    public function actionIndex($ajax = false)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        if ($ajax) {
            return $this->renderAjax('index');
        }
        return $this->render('index');
        // return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (Yii::$app->request->isPost) {
            $model = new LoginForm();
            $req = Yii::$app->request->post();
            $model->username = $req["user_name"];
            $model->password = $req["password"];
            if ($model->login()) {
                // return $this->refresh();
                return 1;
            } else {

                return 0;
            }
            // return $this->redirect(["index"]);
        }
        // if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //     return $this->goBack();
        // }

        // $model->password = '';
        return $this->render('login', [
            // 'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return 1;
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public static function AfGetImage($id, $table_id)
    {
        $uploadDir = Yii::$app->params['physical_path'] . "/uploads/" . $table_id . "/" . $id . "/";
        // make sure the directory is there
        // load images
        $images = AfImages::find()->where(["row_id" => $id])->all();

        $images_arr = [];
        // $arr = ["images" => []];
        if (!empty($images)) {
            foreach ($images as $index => $image) {
                $images_arr["images"][$index]["url"] = $image->image_url;
            }
        }

        return $images_arr;
        // if (!is_dir($uploadDir)) {
        //     mkdir($uploadDir, 0777, true);
        // } else {
        //     // delete the photo that was there before this one
        //     $files = glob($uploadDir . '/*'); // Get list of file paths in the directory
        //     foreach ($files as $index => $file) {
        //         if (is_file($file)) {
        //             $imageContents = file_get_contents($file); // Read the file contents
        //             $filename = basename($file); // Get the filename from the file path

        //             $imageBase64 = base64_encode($imageContents); // Encode the contents to base64
        //             $images["images"][$index] = []; // Create an empty array for the index if it doesn't exist
        //             $images["images"][$index]["dir"] = $uploadDir;
        //             $images["images"][$index]["url"] =  Yii::$app->params["base_path"] . "/uploads/" . $table_id . "/" . $user_id . "/" . $filename;
        //             $images["images"][$index]["base64"] = $imageBase64;
        //             // Use the $imageBase64 as needed, such as storing it in a database or sending it in a response
        //         }
        //     }
        // }

        // return $images;
    }

    public static function AfPostImages($id, $table_id, $model, $imageData, $multiple = true)
    {


        $imageData = explode(",", $imageData);
        $uploadDir = Yii::$app->params['physical_path'] . "\\uploads\\" . $table_id . "\\" . $id;
        $uploadDir_localhost = Yii::$app->params["base_path"] . "/uploads/" . $table_id . "/" . $id . "/";


        $images = [];

        if ($id != "temp") {
            $deleted = AfImages::deleteAll(["row_id" => $id]);
            Yii::warning($deleted);
        }
        if (!empty($imageData)) {
            // make sure the directory is there
            Yii::warning($uploadDir);


            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            } else {
                // delete the photo that was there before this one
                $files = glob($uploadDir . '/*'); // Get list of file paths in the directory

                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file); // Delete the file
                    }
                }
            }
            foreach ($imageData as $index => $imageBase64) {
                if (empty($imageBase64)) {
                    continue;
                }
                // Generate a unique file name for each image
                $fileName = "\\"  .  date('Y-m-d-H-i-s') . '__' . $index . '.png';


                // Decode the base64 image data
                $imageData = base64_decode($imageBase64);


                // Save the image to the upload directory
                file_put_contents($uploadDir . $fileName, $imageData);
                $model->image_url = $uploadDir_localhost . $fileName;

                $url = Yii::$app->params["base_path"] . "/uploads/" . $table_id . "/" . $id . $fileName;
                $images["images"][$index] = []; // Create an empty array for the index if it doesn't exist
                // $images["images"][$index]["dir"] = $uploadDir;
                $images["images"][$index]["url"] =  $url;
                // $images["images"][$index]["base64"] = $imageBase64;

                // Optionally, you can also create an ActiveRecord model and save the image information to a database
                // MULTIPLE IMAGES ADD THEM IN SEPERATE TABLE CALLED af_images create a new row each time with table_id , its primary keys id , the url and created_at
                if ($multiple && $id != "temp") {
                    $af_images = new AfImages();
                    $af_images->row_id = $id;
                    $af_images->table_id = $table_id;
                    $af_images->image_url = $url;
                    // $af_images->created_by = $user_id;
                    $af_images->save();
                }
            }
            $model->save();
        } else {
            $files = glob($uploadDir . '/*'); // Get list of file paths in the directory
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file); // Delete the file
                }
            }
        }

        $images["model"] = $model;

        return $images;
    }


    public function actionAfGetValues()
    {
        $req = Yii::$app->request->get();
        $q = $req["q"];
        $key = $req["key"];
        $representative_field = $req["representative_field"];
        $table = $req["table"];
        $page = $req["page"];
        $condition = $req["condition"];

        $offset = ($page - 1) * 10;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $query = new Query;

        $query->select([$key . ' as id', $representative_field . " AS text"])
            ->from($table)
            ->offset($offset)
            ->limit(10);


        if (!is_null($q) && $q != '') {
            $query->select([$key . ' as id', $representative_field . " AS text"])
                ->from($table)
                ->offset($offset)
                ->limit(10)
                ->where(['like', $representative_field, $q]);
        }


        $command = $query->createCommand();
        // echo $query->createCommand()->getRawSql();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
        $out['pagination'] = ['more' => !empty($data) ? true : false];
        return $out;
    }
    public function actionAfSelectData($page, $q = null, $table, $key, $representative_field, $condition = null)
    {

        $offset = ($page - 1) * 10;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        $query = new Query;

        $query->select([$key . ' as id', $representative_field . " AS text"])
            ->from($table)
            ->offset($offset)
            ->limit(10);


        if (!is_null($q) && $q != '' && $table != "provider") {
            $query->where(['like', $representative_field, $q]);
        }


        $command = $query->createCommand();
        // echo $query->createCommand()->getRawSql();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
        $out['pagination'] = ['more' => !empty($data) ? true : false];
        return $out;
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
