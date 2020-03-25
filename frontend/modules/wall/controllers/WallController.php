<?php

namespace frontend\modules\wall\controllers;

use frontend\modules\wall\models\forms\AddToWallForm;
use Yii;
use yii\web\Controller;

class WallController extends Controller
{
    public function actionAdd(){

        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $model = new AddToWallForm();

                $model->from = Yii::$app->user->id;
                $model->created_at = \time();

                if ($model->load(Yii::$app->request->post()) and $model->save()){

                    return true;

                }

            }

        }

        return $this->goHome();

    }
}