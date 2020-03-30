<?php

namespace frontend\modules\user\controllers;
use frontend\modules\user\models\Profile;
use Yii;


class UserController extends \yii\web\Controller
{

    public function actionIndex($city)
    {

        $model = Profile::find()->where(['id' => \Yii::$app->user->id])->one();

        return $this->render('index', [
            'model' => $model,
        ]);

    }

}
