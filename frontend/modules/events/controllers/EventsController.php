<?php


namespace frontend\modules\events\controllers;

use frontend\modules\events\models\Events;
use Yii;
use yii\web\Controller;

class EventsController extends Controller
{
    public function actionIndex($city)
    {

        $events = Events::find()->where(['user_id' => Yii::$app->user->id])->asArray()->with('profile')->all();

        return $this->render('index', [
            'events' => $events,
            'city' => $city,
        ]);

    }
}