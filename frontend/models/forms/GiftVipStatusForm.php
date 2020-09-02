<?php


namespace frontend\models\forms;


use frontend\modules\user\models\Profile;
use yii\base\Model;

class GiftVipStatusForm extends Model
{
    public $fromUser;
    public $toUser;

    public function rules()
    {
        return [
            [['toUser', 'fromUser'], 'required'],
            [['toUser', 'fromUser'], 'integer'],
        ];
    }

    public function save(){

        if ($this->validate()){

            $profile = Profile::find()->where(['id' => $this->toUser])->one();

            if ($profile->vip_status_work > \time()) $profile->vip_status_work = $profile->vip_status_work + (3600 * 24 * 7);

            else $profile->vip_status_work = \time() + (3600 * 24 * 7) ;

            return $profile->save();

        }

        return false;

    }

}