<?php

namespace frontend\modules\wall\models;

use common\models\Comments;
use frontend\models\Files;
use frontend\modules\group\models\Group;
use frontend\modules\user\models\Profile;
use Yii;

/**
 * This is the model class for table "wall".
 *
 * @property int $id
 * @property int|null $user_id ид пользователя на чьей стене запись
 * @property int|null $from кто автор записи
 * @property int|null $created_at время создания
 * @property string|null $text текст записи
 * @property string|null $class текст записи
 */
class Wall extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wall';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'from', 'created_at'], 'integer'],
            [['text', 'class'], 'string'],
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
            'from' => 'From',
            'created_at' => 'Created At',
            'text' => 'Сообщение',
        ];
    }

    public function getAuthor(){

        return $this->hasOne(Profile::class, ['id' => 'from'])->with('avatarRelation');

    }

    public function getFiles()
    {
        return $this->hasMany(Files::class, ['related_id' => 'id'])->andWhere(['related_class' => Wall::class]);
    }

    public function getComments(){

        return $this->hasMany(Comments::class, ['related_id' => 'id'])->andWhere(['class' => Wall::class])->with('author');

    }
}
