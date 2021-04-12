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

            if($model->currency == 3){

                $order_id = Yii::$app->user->id.'_'.$city;

                $sign = \md5(Yii::$app->params['merchant_id'].':'.$model->sum.':'.Yii::$app->params['fk_merchant_key'].':'.$order_id);

                $email = Yii::$app->user->identity->email;

                $cassa_url = 'https://www.free-kassa.ru/merchant/cash.php?';

                $params = 'm='.Yii::$app->params['merchant_id'].
                    '&oa='.$model->sum.
                    '&o='.$order_id.
                    '&email='.$email.
                    '&s='.$sign;

                return Yii::$app->response->redirect($cassa_url.$params, 301, false);

            }

            $model->user_id = Yii::$app->user->id;
            $model->city = $city;

            if ($payUrl = $model->createPay() and isset($payUrl->pay_link)){

                return $this->redirect($payUrl->pay_link);

            }

            Yii::$app->session->setFlash('warning', 'Ошибка');

        }

        return $this->render('obmenka', [
            'model' => $model
        ]);
    }

}