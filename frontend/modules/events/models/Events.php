<?php

namespace frontend\modules\events\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $timestamp
 * @property int|null $from
 * @property int|null $type
 */
class Events extends \yii\db\ActiveRecord
{

    const NEW_SYMPATHY = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'timestamp', 'from', 'type'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'timestamp' => 'Timestamp',
            'from' => 'From',
            'type' => 'Type',
        ];
    }
}
