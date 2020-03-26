<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $created_at
 * @property int|null $parent_id
 * @property string|null $class
 * @property int|null $related_id
 * @property string|null $text
 * @property string|null $author_id
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'related_id', 'created_at'], 'integer'],
            [['class'], 'string', 'max' => 120],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'class' => 'Class',
            'related_id' => 'Related ID',
            'text' => 'Text',
        ];
    }
}
