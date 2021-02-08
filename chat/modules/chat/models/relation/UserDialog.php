<?php

namespace chat\modules\chat\models\relation;

use frontend\modules\chat\models\Message;
use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "user_dialog".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $dialog_id
 */
class UserDialog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_dialog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'dialog_id'], 'integer'],
            [['user_id', 'dialog_id'], 'required'],
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
            'dialog_id' => 'Dialog ID',
        ];
    }

    public function getMessage(){
        return $this->hasMany(Message::class, ['chat_id' =>'dialog_id' ] )->orderBy('created_at DESC')->with('author');
    }

    public function getLastMessage(){
        return $this->hasOne(Message::class, ['chat_id' =>'dialog_id' ] )->orderBy('created_at DESC')->with('author')->asArray();
    }

    public function getAuthor(){
        return $this->hasOne(Profile::class, ['id' => 'user_id'])->select('id, username')->with('avatarRelation');
    }

    public function getCompanion(){
        return $this->hasOne(UserDialog::class, ['dialog_id' =>'dialog_id'] )->andWhere([ '<>' , 'user_id',  $this->user_id])->with('author')->asArray();
    }

    public function getUser()
    {
        return $this->hasOne(Profile::class, ['id' => 'user_id'])->with('avatarRelation');
    }

}
