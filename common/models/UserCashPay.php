<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_cash_pay".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $count
 */
class UserCashPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_cash_pay';
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

    public static function addCash($date, $cash)
    {
        if ($data = self::find()->where(['date' => $date])->one()){

            $data->count = $data->count + $cash;

        } else {

            $registerCount = new self();

            $registerCount->date = $date;

            $registerCount->count = $cash;

            $registerCount->save();

        }
    }
}
