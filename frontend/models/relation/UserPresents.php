<?php

namespace frontend\models\relation;

use common\models\Presents;
use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "user_presents".
 *
 * @property int $id
 * @property int|null $from ид пользователя от которого подарок
 * @property int|null $to ид пользователя которому подарок
 * @property int|null $resent_id ид подарка
 * @property int|null $timestamp
 * @property string|null $message
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
            [['message'], 'string'],
        ];
    }

    public function getPresent(){
        return $this->hasOne(Presents::class, ['id' => 'resent_id']);
    }

    public function getAuthor(){

        return $this->hasOne(Profile::class, ['id' => 'from'])->with('userAvatarRelations');

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
