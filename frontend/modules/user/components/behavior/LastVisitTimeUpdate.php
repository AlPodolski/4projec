<?php

namespace frontend\modules\user\components\behavior;

use frontend\modules\user\models\Profile;
use yii\base\Behavior;
use Yii;

class LastVisitTimeUpdate extends Behavior
{
    public function events()
    {
        return [
            yii\web\Controller::EVENT_BEFORE_ACTION => 'checkAuth'
        ];
    }

    public function checkAuth(){

        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->user->identity['last_visit_time'] < \time() - 3600)
                Profile::updateAll(['last_visit_time' => time()], ['id' => Yii::$app->user->identity['id']]);

        }

    }
}