<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "meta".
 *
 * @property int $id
 * @property string|null $city
 * @property string|null $tag
 */
class Meta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'tag' => 'Tag',
        ];
    }
}
