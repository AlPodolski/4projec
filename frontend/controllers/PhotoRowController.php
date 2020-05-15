<?php


namespace frontend\controllers;

use frontend\modules\user\models\Popular;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class PhotoRowController extends Controller
{
    public function actionGetForm()
    {
        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $photoRowForm = new Popular();

                $user = Profile::find()->where(['id' => Yii::$app->user->id])->with('avatarRelation')->asArray()->one();

                return $this->renderFile('@app/views/photo-row/photo-row-form.php', [
                    'photoRowForm' => $photoRowForm,
                    'user' => $user,
                ]);

            }

        }

        return $this->goHome();
    }
}