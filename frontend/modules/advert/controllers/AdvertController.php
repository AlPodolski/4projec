<?php


namespace frontend\modules\advert\controllers;

use yii\web\Controller;
use frontend\modules\advert\models\Advert;
use Yii;
class AdvertController extends Controller
{
    public function actionAd()
    {

        if (Yii::$app->user->isGuest) return $this->goHome();

        $model = new Advert();

        $model->timestamp = \time();

        $model->user_id = Yii::$app->user->id;

        if (Yii::$app->request->isPost and $model->load(Yii::$app->request->post()) and $model->save()){

            Yii::$app->session->setFlash('success', 'Объяление добавлено');

            return $this->redirect('/user');

        }

        return $this->render('ad', [
            'model' => $model,
        ]);

    }
}