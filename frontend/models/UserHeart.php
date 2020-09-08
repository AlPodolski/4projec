<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_heart".
 *
 * @property int $id
 * @property int|null $who Кто занял сердце
 * @property int|null $whom Чье сердце занято
 * @property int|null $timestamp
 */
class UserHeart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_heart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['who', 'whom', 'timestamp'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'who' => 'Who',
            'whom' => 'Whom',
            'timestamp' => 'Timestamp',
        ];
    }
}
