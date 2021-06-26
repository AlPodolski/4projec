<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $mail
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $user_id
 */
class Feedback extends \yii\db\ActiveRecord
{
    const NOT_READ = 0;
    const READ = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'user_id'], 'integer'],
            [['text', 'mail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'mail' => 'Mail',
            'status' => 'Status',
            'created_at' => 'Created At',
            'user_id ' => 'user id',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
