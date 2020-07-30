<?php

namespace frontend\modules\group\models;

use Yii;

/**
 * This is the model class for table "group_item".
 *
 * @property int $id
 * @property int|null $group_id
 * @property int|null $author_id
 * @property string|null $text
 * @property int|null $created_at
 *
 * @property Group $group
 */
class GroupItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'author_id', 'created_at'], 'integer'],
            [['text'], 'string'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'author_id' => 'Author ID',
            'text' => 'Text',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
