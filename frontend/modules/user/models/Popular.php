<?php

namespace frontend\modules\user\models;

use Yii;

/**
 * This is the model class for table "popular".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $created_at
 */
class Popular extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'popular';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
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
            'created_at' => 'Created At',
        ];
    }

    public function getProfile(){

        return $this->hasOne(Profile::class, ['id' => 'user_id'])->with('userAvatarRelations');

    }
}
