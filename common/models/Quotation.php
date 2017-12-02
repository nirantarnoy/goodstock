<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property int $id
 * @property string $quotation_no
 * @property int $require_date
 * @property int $customer_id
 * @property string $customer_ref
 * @property int $approve_status
 * @property int $approve_by
 * @property int $approve_date
 * @property double $total_amount
 * @property string $note
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Quotation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['require_date', 'customer_id', 'approve_status', 'approve_by', 'approve_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['total_amount'], 'number'],
            [['quotation_no', 'customer_ref', 'note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'quotation_no' => Yii::t('app', 'Quotation No'),
            'require_date' => Yii::t('app', 'Require Date'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'customer_ref' => Yii::t('app', 'Customer Ref'),
            'approve_status' => Yii::t('app', 'Approve Status'),
            'approve_by' => Yii::t('app', 'Approve By'),
            'approve_date' => Yii::t('app', 'Approve Date'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'note' => Yii::t('app', 'Note'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
