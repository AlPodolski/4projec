<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "import_news_from_vk".
 *
 * @property int $id
 * @property string|null $group_url урл группы с которой была взята новость
 * @property int|null $time метка времени ноаости из группы вк
 */
class ImportNewsFromVk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'import_news_from_vk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'integer'],
            [['group_url'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_url' => 'Group Url',
            'time' => 'Time',
        ];
    }
}
