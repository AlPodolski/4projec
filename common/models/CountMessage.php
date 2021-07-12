<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "count_message".
 *
 * @property int $id
 * @property string|null $user_name
 * @property string|null $date
 * @property int|null $count
 */
class CountMessage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'count_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['user_name', 'date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'date' => 'Date',
            'count' => 'Count',
        ];
    }

    public static function addCount($date, $user_name)
    {
        if (self::find()->where(['date' => $date, 'user_name' => $user_name])->count()){

            self::updateAllCounters(['count' => 1] , ['date' => $date,  'user_name' => $user_name]);

        } else {

            $registerCount = new self();

            $registerCount->date = $date;

            $registerCount->count = 1;

            $registerCount->user_name = $user_name;

            $registerCount->save();

            \dd($registerCount->getErrors());

        }
    }
}
