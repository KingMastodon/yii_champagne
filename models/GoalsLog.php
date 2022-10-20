<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goals_log".
 *
 * @property int $id
 * @property int|null $created_at
 * @property string|null $goal
 * @property int|null $price
 * @property int|null $data_provider
 * @property int|null $status
 */
class GoalsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goals_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'price', 'data_provider', 'status'], 'integer'],
            [['created_at', 'price', 'data_provider', 'status'], 'required'],
            [['goal'], 'string'],
            [['goal'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'created_at' => 'Создано',
            'goal' => 'Событие',
            'price' => 'Стоимость',
            'data_provider' => 'Поставщик',
            'status' => 'Статус подтверждения',
        ];
    }
}
