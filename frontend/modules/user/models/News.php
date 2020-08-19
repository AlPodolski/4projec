<?php

namespace frontend\modules\user\models;

use frontend\modules\wall\models\Wall;
use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int|null $user_id ид пользователя для которого новость
 * @property string|null $related_class связанный класс
 * @property int|null $news_id ид новости
 * @property int|null $timestamp Время добавления
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'news_id', 'timestamp'], 'integer'],
            [['related_class'], 'string', 'max' => 122],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'related_class' => 'Related Class',
            'news_id' => 'News ID',
            'timestamp' => 'Timestamp',
        ];
    }

    public function getWall()
    {
        return $this->hasOne(Wall::class, ['id' => 'news_id'])->with('files')->with('comments')->with('parent');
    }
}
