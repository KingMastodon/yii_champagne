<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goals_apis".
 *
 * @property int $id
 * @property string $base_url
 * @property string $id_param_name
 * @property string $goal_param_name
 * @property string $price_param_name
 * @property string $request_type
 */
class GoalsApis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goals_apis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base_url', 'id_param_name', 'goal_param_name', 'price_param_name', 'request_type'], 'required'],
            [['base_url'], 'string'],
            [['id_param_name', 'goal_param_name', 'price_param_name'], 'string', 'max' => 255],
            [['request_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base_url' => 'Base Url',
            'id_param_name' => 'Id Param Name',
            'goal_param_name' => 'Goal Param Name',
            'price_param_name' => 'Price Param Name',
            'request_type' => 'Request Type',
        ];
    }
}
