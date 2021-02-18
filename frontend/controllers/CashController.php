<?php


namespace frontend\controllers;

use frontend\models\forms\BuyVipStatusForm;
use frontend\models\forms\GiftVipStatusForm;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class CashController extends Controller
{
    public function actionPay()
    {
        $data = Yii::$app->request->post();

        $user_data = \explode('_', $data['MERCHANT_ORDER_ID']);

        $post = Profile::find()->where(['id' => $user_data['0']])->one();

        if (isset($user_data[2]) and $user_data[2] == 'vip'){

            $vipForm = new BuyVipStatusForm();

            $vipForm->user_id = $user_data[0];

            $vipForm->save();

            $post->sum = Yii::$app->params['vip_status_week_price'];

            Yii::$app->session->setFlash('success', 'Досуг vip подключен');

        }
        elseif (isset($user_data[2]) and $user_data[2] == 'vipgift'){

            $vipForm = new GiftVipStatusForm();

            $vipForm->fromUser = $user_data[0];
            $vipForm->toUser = $user_data[3];

            $post->sum = Yii::$app->params['vip_status_week_price'];

            $vipForm->save();

            Yii::$app->session->setFlash('success', 'Досуг vip подключен');

        }else {

            $post->cash = $post->cash + (int) $data['AMOUNT'];

            $post->sum = $post->sum + (int) $data['AMOUNT'];

            $post->save();

            Yii::$app->session->setFlash('success', 'Баланс пополнен');

        }

        Yii::$app->response->redirect('https://'.$user_data[1].'.4dosug.com/user', 301, false);

    }
}