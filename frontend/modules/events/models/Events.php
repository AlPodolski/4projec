<?php

namespace frontend\modules\events\models;

use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $timestamp
 * @property int|null $from
 * @property int|null $type
 * @property int|null $status
 * @property string|null $class
 * @property int|null $related_id
 */
class Events extends \yii\db\ActiveRecord
{

    const NEW_SYMPATHY = 1;
    const MUTUAL_SYMPATHY = 2;
    const NEW_COMMENT = 3;

    const STATUS_NOT_READ = 0;
    const STATUS_READ = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'timestamp', 'from', 'type', 'status'], 'integer'],
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'user_id'])->with('userAvatarRelations');
    }

    public function getFromProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'from'])->with('userAvatarRelations')->with('polRelation');
    }

    public static function getParent(string $class, int $id)
    {
        return $class::find()->where(['id' => $id])->select('text')->asArray()->one();
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
            'from' => 'From',
            'type' => 'Type',
        ];
    }
}
