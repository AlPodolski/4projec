<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "register_count".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $count
 */
class RegisterCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'register_count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['date'], 'string', 'max' => 24],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'count' => 'Count',
        ];
    }

    public static function addRegister($date)
    {
        if (RegisterCount::find()->where(['date' => $date])->count()){

            RegisterCount::updateAllCounters(['count' => 1] , ['date' => $date]);

        }else {

            $registerCount = new RegisterCount();

            $registerCount->date = $date;

            $registerCount->count = 1;

            $registerCount->save();

        }
    }

}
