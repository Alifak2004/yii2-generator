<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description_sm
 * @property string $description_lg
 * @property int $qty
 * @property int $actual_qty
 * @property int $views
 * @property float $weight
 * @property float $cost
 * @property float $wholesale_price
 * @property float $retail_price
 * @property float $clearance_price
 * @property string $brand
 * @property float|null $shipping_cost
 * @property float $vat
 * @property int $low_qty_alert
 * @property float $discount_rate
 * @property string $product_condition
 * @property string $status
 * @property int $featured
 * @property int $visible
 * @property int $recommended
 * @property int $main_page
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
                return [
            [['description_sm', 'description_lg', 'product_condition', 'status'], 'string'],
            [['description_lg', 'qty', 'actual_qty', 'weight', 'cost', 'wholesale_price', 'retail_price', 'clearance_price', 'brand', 'vat', 'low_qty_alert', 'discount_rate', 'product_condition', 'status'], 'required'],
            [['qty', 'actual_qty', 'views', 'low_qty_alert', 'featured', 'visible', 'recommended', 'main_page'], 'integer'],
            [['weight', 'cost', 'wholesale_price', 'retail_price', 'clearance_price', 'shipping_cost', 'vat', 'discount_rate'], 'number'],
            [['name', "image_url"], 'string', 'max' => 200],
            [["image_url"], 'string', 'max' => 300],
            [['brand'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
            return [
            'name' => Yii::t('app', 'Name'),
            'description_sm' => Yii::t('app', 'Description Sm'),
            'description_lg' => Yii::t('app', 'Description Lg'),
            'qty' => Yii::t('app', 'Qty'),
            'actual_qty' => Yii::t('app', 'Actual Qty'),
            'views' => Yii::t('app', 'Views'),
            'weight' => Yii::t('app', 'Weight'),
            'cost' => Yii::t('app', 'Cost'),
            'wholesale_price' => Yii::t('app', 'Wholesale Price'),
            'retail_price' => Yii::t('app', 'Retail Price'),
            'clearance_price' => Yii::t('app', 'Clearance Price'),
            'brand' => Yii::t('app', 'Brand'),
            'shipping_cost' => Yii::t('app', 'Shipping Cost'),
            'vat' => Yii::t('app', 'Vat'),
            'low_qty_alert' => Yii::t('app', 'Low Qty Alert'),
            'discount_rate' => Yii::t('app', 'Discount Rate'),
            'product_condition' => Yii::t('app', 'Product Condition'),
            'status' => Yii::t('app', 'Status'),
            'featured' => Yii::t('app', 'Featured'),
            'visible' => Yii::t('app', 'Visible'),
            'recommended' => Yii::t('app', 'Recommended'),
            'main_page' => Yii::t('app', 'Main Page'),
                ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
