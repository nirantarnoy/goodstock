<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int $gender_id
 * @property int $prefix
 * @property string $first_name
 * @property string $last_name
 * @property int $section_id
 * @property int $position_id
 * @property string $description
 * @property string $photo
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender_id', 'prefix', 'section_id', 'position_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['first_name', 'last_name', 'description', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'gender_id' => Yii::t('app', 'Gender ID'),
            'prefix' => Yii::t('app', 'Prefix'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'section_id' => Yii::t('app', 'Section ID'),
            'position_id' => Yii::t('app', 'Position ID'),
            'description' => Yii::t('app', 'Description'),
            'photo' => Yii::t('app', 'Photo'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
