<?php

namespace frontend\modules\wall\controllers;

use frontend\modules\wall\models\forms\AddCommentForm;
use frontend\modules\wall\models\forms\AddToWallForm;
use Yii;
use yii\web\Controller;
use frontend\modules\wall\models\Wall;

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

    public function actionComment()
    {
        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $model = new AddCommentForm();

                $model->author_id = Yii::$app->user->id;
                $model->created_at = \time();
                $model->class = Wall::class;

                if ($model->load(Yii::$app->request->post()) and $model->save()){

                    return true;

                }

            }

        }

        return $this->goHome();
    }
}