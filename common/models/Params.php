<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property int $id
 * @property int|null $category_param_id
 * @property string|null $param
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_param_id'], 'integer'],
            [['param'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_param_id' => 'Category Param ID',
            'param' => 'Param',
        ];
    }
}
