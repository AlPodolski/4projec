<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "presents".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $img
 * @property int|null $status
 * @property int|null $price
 */
class Presents extends \yii\db\ActiveRecord
{
    const PODAROK_DOSTUPEN = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'img'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'img' => 'Img',
            'status' => 'Status',
        ];
    }
}
