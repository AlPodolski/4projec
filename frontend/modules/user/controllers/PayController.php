<?php


namespace frontend\modules\user\controllers;

use frontend\models\forms\ObmenkaPayForm;
use Yii;
use yii\web\Controller;

class PayController extends Controller
{
    public function actionObmenkaPay($city)
    {

        $model = new ObmenkaPayForm();

        if ($model->load(Yii::$app->request->post())){

            $model->user_id = Yii::$app->user->id;
            $model->city = $city;

            if ($payUrl = $model->createPay() and isset($payUrl->pay_link)){

                $this->redirect($payUrl->pay_link);

            }

            Yii::$app->session->setFlash('warning', 'Ошибка');

        }

        return $this->render('obmenka', [
            'model' => $model
        ]);
    }
}