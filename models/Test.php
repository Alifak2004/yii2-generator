<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string|null $column1
 * @property int|null $column2
 * @property float|null $column3
 * @property string|null $column4
 * @property string|null $column5
 * @property string|null $column6
 * @property int|null $column7
 * @property string|null $column8
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
                return [
            [['column2', 'column7'], 'integer'],
            [['column3'], 'number'],
            [['column4'], 'safe'],
            [['column5', 'column6'], 'string'],
            [['column1'], 'string', 'max' => 255],
            [['column8'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
            return [
            'column1' => Yii::t('app', 'Column1'),
            'column2' => Yii::t('app', 'Column2'),
            'column3' => Yii::t('app', 'Column3'),
            'column4' => Yii::t('app', 'Column4'),
            'column5' => Yii::t('app', 'Column5'),
            'column6' => Yii::t('app', 'Column6'),
            'column7' => Yii::t('app', 'Column7'),
            'column8' => Yii::t('app', 'Column8'),
                ];
    }

    /**
     * {@inheritdoc}
     * @return TestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TestQuery(get_called_class());
    }
}
