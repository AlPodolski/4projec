<?php

namespace common\models;

use Yii;
use yii\base\BaseObject;

/**
 * This is the model class for table "promo_register_count".
 *
 * @property int $id
 * @property string|null $date
 * @property int|null $count
 */
class PromoRegisterCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_register_count';
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
        if (self::find()->where(['date' => $date])->count()){

            self::updateAllCounters(['count' => 1] , ['date' => $date]);

        } else {

            $registerCount = new self();

            $registerCount->date = $date;

            $registerCount->count = 1;

            $registerCount->save();

        }
    }

}
