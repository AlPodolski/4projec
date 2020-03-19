<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "present_to_category".
 *
 * @property int|null $present_id
 * @property int|null $category_id
 */
class PresentToCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'present_to_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['present_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'present_id' => 'Present ID',
            'category_id' => 'Category ID',
        ];
    }
}
