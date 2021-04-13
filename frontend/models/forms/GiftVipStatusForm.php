<?php


namespace frontend\models\forms;


use frontend\modules\user\models\Profile;
use Yii;
use yii\base\Model;

class GiftVipStatusForm extends Model
{
    public $fromUser;
    public $toUser;
    public $sum;

    public function rules()
    {
        return [
            [['toUser', 'fromUser', 'sum'], 'required'],
            [['toUser', 'fromUser', 'sum'], 'integer'],
        ];
    }

    public function save(){

        if ($this->validate()){

            $profile = Profile::find()->where(['id' => $this->toUser])->one();

            $time = $this->getTime();

            if ($profile->vip_status_work > \time()) $profile->vip_status_work = $profile->vip_status_work + $time;

            else $profile->vip_status_work = \time() + $time ;

            return $profile->save();

        }

        return false;

    }

    public function getTime()
    {

        switch ($this->sum) {
            case Yii::$app->params['vip_status_three_month_price']:
                return (3600 * 24 * 30 * 3);
            case Yii::$app->params['vip_status_month_price']:
                return (3600 * 24 * 30);
            case Yii::$app->params['vip_status_week_price']:
                return (3600 * 24 * 7);
            case Yii::$app->params['vip_status_day_price']:
                return (3600 * 24 * 1);
        }

        return false;

    }

}