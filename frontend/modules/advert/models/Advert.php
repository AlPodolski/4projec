<?php

namespace frontend\modules\advert\models;

use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;

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

    public function getUserName(){

        return ArrayHelper::getValue(Profile::find()->where(['id' => $this->user_id])->asArray()->one(), 'username');

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
