<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\web\UploadedFile;


/**
 * This is the model class for table "users".
 *
 * @property int $user_id
 * @property string $user_name
 * @property string $first_name
 * @property string $last_name
 * @property string|null $birth_date
 * @property string|null $email
 * @property string|null $last_url
 * @property string $password
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $zip_code
 * @property int $role
 * @property string|null $image_url
 */
use yii\web\IdentityInterface;

class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        return 'users';
    }
    
    /**
     * Uploaded file variable for the image input.
     * @var UploadedFile
     */
    public $imageFile;

    
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['user_name', 'first_name', 'last_name', 'password', 'role'], 'required'],
            [['birth_date', 'created_at'], 'safe'],
            [['created_by', 'role'], 'integer'],
            [['user_name', 'first_name', 'last_name', 'password'], 'string', 'max' => 100],
            [['email', 'address'], 'string', 'max' => 150],
            [['last_url', 'image_url'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            [['zip_code'], 'string', 'max' => 30],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'email' => Yii::t('app', 'Email'),
            'last_url' => Yii::t('app', 'Last Url'),
            'password' => Yii::t('app', 'Password'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'role' => Yii::t('app', 'Role'),
            'image_url' => Yii::t('app', 'Image Url'),
            'imageFile' => Yii::t('app', 'Image'),  
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

    public function upload()
    {
        if ($this->validate()) {
            // Create a unique filename
            $fileName = Yii::$app->security->generateRandomString(10) . '.' . $this->imageFile->extension;
            // Save the uploaded file
            $this->imageFile->saveAs('path/to/save/directory/' . $fileName);
            // Set the image_url attribute with the filename
            $this->image_url = $fileName;
            return true;
        }
        return false;
    }


    public static function findIdentity($id)
    {
        return static::findOne(["user_id" => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implement this method if you are using access tokens for authentication.
        return null;
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        // Implement this method if you are using access tokens for authentication.
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Implement this method if you are using access tokens for authentication.
        return false;
    }


    // $security = new Security();
    // $this->password = $security->generatePasswordHash($password);
    public function validatePassword($password)
    {
        // $security = new Security();
        // return $security->validatePassword($password, $this->password);
        return $this->password === $password;
    }


}
