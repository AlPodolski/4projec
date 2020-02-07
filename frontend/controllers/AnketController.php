<?php


namespace frontend\controllers;
use frontend\modules\user\models\Profile;
use yii\web\Controller;

class AnketController extends Controller
{
    public function actionView($id){

        $model = Profile::find()->where(['id' => $id])->one();

        return $this->render('anket' , [
            'model' => $model
        ]);

    }
}