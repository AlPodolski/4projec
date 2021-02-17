<?php


namespace frontend\controllers;

use frontend\models\forms\BuyVipStatusForm;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class CashController extends Controller
{
    public function actionPay()
    {
        $data = Yii::$app->request->post();

        $user_data = \explode('_', $data['MERCHANT_ORDER_ID']);

        if (isset($user_data[2]) and $user_data[2] == 'vip'){

            $vipForm = new BuyVipStatusForm();

            $vipForm->user_id = $user_data['0'];

            $vipForm->save();

            Yii::$app->session->setFlash('success', 'Досуг vip подключен');

        }else {

            $post = Profile::find()->where(['id' => $user_data['0']])->one();

            $post->cash = $post->cash + (int) $data['AMOUNT'];

            $post->save();

            Yii::$app->session->setFlash('success', 'Баланс пополнен');

        }

        Yii::$app->response->redirect('https://'.$user_data[1].'.4dosug.com/user', 301, false);

    }
}