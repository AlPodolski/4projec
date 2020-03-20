<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "user_presents".
 *
 * @property int $id
 * @property int|null $from ид пользователя от которого подарок
 * @property int|null $to ид пользователя которому подарок
 * @property int|null $resent_id ид подарка
 * @property int|null $timestamp
 */
class UserPresents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_presents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'resent_id', 'timestamp'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'resent_id' => 'Resent ID',
            'timestamp' => 'Timestamp',
        ];
    }
}
