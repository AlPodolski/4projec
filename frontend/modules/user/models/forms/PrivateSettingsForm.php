<?php


namespace frontend\modules\user\models\forms;

use frontend\modules\user\models\UserPrivacySetting;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class PrivateSettingsForm extends Model
{
    public $user_id;

    public $params;

    public function attributeLabels()
    {
        return [
            'params' => 'Кто может мне писать (Оставить пустым что бы снять ограничения)',
        ];
    }

    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['params'], 'safe'],
        ];
    }

    public function save()
    {

        UserPrivacySetting::deleteAll(['user_id' => $this->user_id]);

        if (!\is_array($this->params )) return true;

        foreach ($this->params as $param){

            $privacySettings = new UserPrivacySetting();

            $privacySettings->user_id = $this->user_id;

            $privacySettings->param = $param;

            $privacySettings->save();

        }

        return true;

    }

    public function getParams($user_id)
    {
        $this->params = ArrayHelper::getColumn(UserPrivacySetting::find()->where(['user_id' => $user_id])->asArray()->all(), 'param');
    }
    
}