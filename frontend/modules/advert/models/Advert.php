<?php

namespace frontend\modules\advert\models;

use Yii;

/**
 * This is the model class for table "advert".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $timestamp
 * @property string|null $text
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'timestamp'], 'integer'],
            [['text'], 'string'],
            [['text'], 'required'],
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
            'text' => 'Добавить объявление',
        ];
    }
}
