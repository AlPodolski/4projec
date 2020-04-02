<?php

namespace frontend\modules\chat\models;

use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int|null $chat_id
 * @property int|null $from
 * @property string|null $message
 * @property int|null $created_at
 * @property int|null $status Отражает состояние сообщения, прочитано или нет
 * @property int $id
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'from', 'created_at', 'status'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chat_id' => 'Chat ID',
            'from' => 'From',
            'message' => 'Message',
            'created_at' => 'Created At',
            'status' => 'Status',
            'id' => 'ID',
        ];
    }

    public function getAuthor(){

        return $this->hasOne(Profile::class, ['id' => 'from'])->select('id, username')->with('avatarRelation');

    }
}
