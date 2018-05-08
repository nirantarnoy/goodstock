<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_line".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property string $noneitem_name
 * @property double $qty
 * @property double $price
 * @property double $disc_amount
 * @property double $disc_percent
 * @property double $line_amount
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class SaleLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_id', 'product_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['qty', 'price', 'disc_amount', 'disc_percent', 'line_amount'], 'number'],
            [['noneitem_name', 'note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sale_id' => Yii::t('app', 'Sale ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'noneitem_name' => Yii::t('app', 'Noneitem Name'),
            'qty' => Yii::t('app', 'Qty'),
            'price' => Yii::t('app', 'Price'),
            'disc_amount' => Yii::t('app', 'Disc Amount'),
            'disc_percent' => Yii::t('app', 'Disc Percent'),
            'line_amount' => Yii::t('app', 'Line Amount'),
            'note' => Yii::t('app', 'Note'),
            'status' => Yii::t('app', 'สถานะ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'updated_at' => Yii::t('app', 'แก้ไขเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }
}
