<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchreq".
 *
 * @property int $id
 * @property string $purchreq_no
 * @property int $require_date
 * @property int $request_by
 * @property string $reason
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
class Purchreq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchreq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['require_date', 'request_by', 'approve_status', 'approve_by', 'approve_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['total_amount'], 'number'],
            [['purchreq_no', 'reason', 'note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'purchreq_no' => Yii::t('app', 'Purchreq No'),
            'require_date' => Yii::t('app', 'Require Date'),
            'request_by' => Yii::t('app', 'Request By'),
            'reason' => Yii::t('app', 'Reason'),
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
