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

    public function actionList($city){

        $advertList = Advert::find()->limit(Yii::$app->params['advert_limit'])->orderBy('id DESC')->all();

        return $this->render('advert', [
            'advertList' => $advertList
        ]);
    }

    public function actionView($city, $id)
    {
        $advert = Advert::find()->where(['id' => $id])->asArray()->one();

        return $this->render('view', [
            'advert' => $advert
        ]);
    }

    public function actionMore()
    {
        if (Yii::$app->request->isPost){

            $advertList = Advert::find()->limit(Yii::$app->params['advert_limit'])->offset(Yii::$app->params['advert_limit'] * Yii::$app->request->post('page'))->orderBy('id DESC')->all();

            if ($advertList) return $this->renderFile('@app/modules/advert/views/advert/more.php', [
                'advertList' => $advertList
            ]);

        }

        exit();
    }

}