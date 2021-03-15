<?php

namespace frontend\components\service\advertisin\models;

use frontend\models\Files;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "Posts".
 *
 * @property int $id
 * @property int|null $city_id
 * @property int|null $user_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $about
 * @property int|null $category
 * @property int|null $check_photo_status
 * @property int|null $price
 * @property string|null $video
 * @property int|null $age
 * @property int|null $rost
 * @property int|null $breast
 * @property int|null $ves
 * @property int|null $status Статус публикации анкеты, 0 на модерации, 1 публикуется 2 не публикуется
 */
class Posts extends \yii\db\ActiveRecord
{

    public $filesClass = 'frontend\modules\user\models\Posts';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Posts';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'user_id', 'created_at', 'updated_at', 'category', 'check_photo_status', 'price', 'age', 'rost', 'breast', 'ves', 'status'], 'integer'],
            [['about'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 20],
            [['video'], 'string', 'max' => 122],
        ];
    }


    public function getAvatar() : ActiveQuery
    {
        return $this->hasOne(Files::class, ['related_id' => 'id'])
            ->where(['related_class' => $this->filesClass])
            ->andWhere(['main' => 1]);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'Name',
            'phone' => 'Phone',
            'about' => 'About',
            'category' => 'Category',
            'check_photo_status' => 'Check Photo Status',
            'price' => 'Price',
            'video' => 'Video',
            'age' => 'Age',
            'rost' => 'Rost',
            'breast' => 'Breast',
            'ves' => 'Ves',
            'status' => 'Status',
        ];
    }
}
