<?php


namespace frontend\modules\events\controllers;

use frontend\modules\events\models\Events;
use Yii;
use yii\web\Controller;

class EventsController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {

        $events = Events::find()->where(['user_id' => Yii::$app->user->id])->asArray()
            ->with('profile')
            ->with('fromProfile')
            ->orderBy('id DESC')
            ->limit(12)
            ->all();

        Events::updateAll(['status' => 1], ['user_id' => Yii::$app->user->id]);

        return $this->render('index', [
            'events' => $events,
            'city' => $city,
        ]);

    }
}