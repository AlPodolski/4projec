<?php

namespace frontend\modules\user\controllers;
use frontend\modules\user\models\Profile;


class UserController extends \yii\web\Controller
{

    public function actionIndex($city)
    {

        $model = Profile::find()->where(['id' => \Yii::$app->user->id])->one();

        return $this->render('index', [
            'model' => $model,
        ]);

    }

    public function actionView($city, $id){

        $model = Profile::find()->where(['id' => $id])
            ->with('place')
            ->with('sexual')
            ->with('bodyType')
            ->with('national')
            ->with('financialSituation')
            ->with('interesting')
            ->with('professionals')
            ->with('vneshnost')
            ->with('children')
            ->with('family')
            ->with('wantFind')
            ->with('celiZnakomstvamstva')
            ->with('haracter')
            ->with('lifeGoals')
            ->with('smoking')
            ->with('alcogol')
            ->with('education')
            ->with('breast')
            ->with('intimHair')
            ->with('hairColor')
            ->with('sferaDeyatelnosti')
            ->with('zhile')
            ->with('transport')
            ->one();

        return $this->render('single' , [
            'model' => $model
        ]);

    }

}
