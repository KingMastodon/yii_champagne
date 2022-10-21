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
    
    const STATUS_NOT_APPROVED = 0;
    const STATUS_APPROVED = 1;

    const STATUS_MAP = [
        self::STATUS_NOT_APPROVED => 'создан',
        self::STATUS_APPROVED => 'подтвержден',
    ];
    
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
            [['created_at', 'price', 'status','data_provider'], 'integer'],
            ['data_provider',  'default', 'value' => null],
            [['created_at', 'price', 'status'], 'required'],
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
