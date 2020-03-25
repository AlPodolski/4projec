<?php

namespace frontend\modules\wall\models;

use Yii;

/**
 * This is the model class for table "wall".
 *
 * @property int $id
 * @property int|null $user_id ид пользователя на чьей стене запись
 * @property int|null $from кто автор записи
 * @property int|null $created_at время создания
 * @property string|null $text текст записи
 */
class Wall extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wall';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'from', 'created_at'], 'integer'],
            [['text'], 'string'],
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
            'from' => 'From',
            'created_at' => 'Created At',
            'text' => 'Text',
        ];
    }
}
