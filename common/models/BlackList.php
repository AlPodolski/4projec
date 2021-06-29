<?php

namespace common\models;

use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "black_list".
 *
 * @property int $id
 * @property int|null $user_id
 */
class BlackList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'black_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Profile::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
        ];
    }
}
