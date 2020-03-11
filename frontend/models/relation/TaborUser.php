<?php

namespace frontend\models\relation;

use Yii;

/**
 * This is the model class for table "tabor_user".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $tabor_id
 */
class TaborUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tabor_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['tabor_id'], 'string', 'max' => 50],
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
            'tabor_id' => 'Tabor ID',
        ];
    }
}
