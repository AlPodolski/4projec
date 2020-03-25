<?php

namespace frontend\modules\chat\models\relation;

use Yii;

/**
 * This is the model class for table "user_dialog".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $dialog_id
 */
class UserDialog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_dialog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'dialog_id'], 'integer'],
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
            'dialog_id' => 'Dialog ID',
        ];
    }
}