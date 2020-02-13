<?php


namespace frontend\controllers;
use frontend\modules\user\models\Profile;
use yii\web\Controller;

class AnketController extends Controller
{
    public function actionView($city, $id){

        $model = Profile::find()->where(['id' => $id])->one();

        return $this->render('single' , [
            'model' => $model
        ]);

    }
}