<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_balance".
 *
 * @property int $id
 * @property int $product_id
 * @property int $site
 * @property int $warehouse_id
 * @property int $location_id
 * @property double $qty
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class StockBalance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'site', 'warehouse_id', 'location_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['qty'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'site' => Yii::t('app', 'Site'),
            'warehouse_id' => Yii::t('app', 'Warehouse ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'qty' => Yii::t('app', 'Qty'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
