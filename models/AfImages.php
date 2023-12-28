<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "af_images".
 *
 * @property int $id
 * @property string $image_url
 * @property int $table_id
 * @property int $row_id
 * @property string $created_at
 * @property int|null $created_by
 */
class AfImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'af_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
                return [
            [['image_url', 'table_id', 'row_id'], 'required'],
            [['table_id', 'row_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['image_url'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
            return [
            'image_url' => Yii::t('app', 'Image Url'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
                ];
    }

    /**
     * {@inheritdoc}
     * @return AfImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AfImagesQuery(get_called_class());
    }
}
