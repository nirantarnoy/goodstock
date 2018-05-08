<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sequence".
 *
 * @property int $id
 * @property int $plant_id
 * @property int $module_id
 * @property string $prefix
 * @property string $symbol
 * @property int $use_year
 * @property int $use_month
 * @property int $use_day
 * @property int $minimum
 * @property int $maximum
 * @property int $currentnum
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Sequence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sequence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prefix','module_id'],'required'],
            [['plant_id', 'module_id', 'use_year', 'use_month', 'use_day', 'minimum', 'maximum', 'currentnum', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['prefix', 'symbol'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plant_id' => Yii::t('app', 'Plant ID'),
            'module_id' => Yii::t('app', 'Module ID'),
            'prefix' => Yii::t('app', 'Prefix'),
            'symbol' => Yii::t('app', 'Symbol'),
            'use_year' => Yii::t('app', 'Use Year'),
            'use_month' => Yii::t('app', 'Use Month'),
            'use_day' => Yii::t('app', 'Use Day'),
            'minimum' => Yii::t('app', 'Minimum'),
            'maximum' => Yii::t('app', 'Maximum'),
            'currentnum' => Yii::t('app', 'Currentnum'),
            'status' => Yii::t('app', 'สถานะ'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'updated_at' => Yii::t('app', 'แก้ไขเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }
}
