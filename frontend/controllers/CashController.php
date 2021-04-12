<?php


namespace frontend\controllers;

use common\models\ObmenkaOrder;
use frontend\components\service\obmenka\Obmenka;
use frontend\models\forms\BuyVipStatusForm;
use frontend\models\forms\GiftVipStatusForm;
use frontend\modules\user\models\Profile;
use Yii;
use yii\base\BaseObject;
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

            $vipForm->sum = (int) $data['AMOUNT'];

            $vipForm->save();

            Yii::$app->session->setFlash('success', 'Досуг vip подключен');

        }
        elseif (isset($user_data[2]) and $user_data[2] == 'vipgift'){

            $vipForm = new GiftVipStatusForm();

            $vipForm->fromUser = $user_data[0];
            $vipForm->toUser = $user_data[3];

            $post->sum = $post->sum + Yii::$app->params['vip_status_week_price'];

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

    public function actionObmenkaPay($city,$protocol, $id)
    {

        if ($order = ObmenkaOrder::findOne($id) and $order['status'] == ObmenkaOrder::WAIT and $user = Profile::findOne($order['user_id'])){

            $obmenka = new Obmenka();

            $data = $obmenka->getOrderInfo($id);

            if (isset($data->amount)){

                $transaction = Yii::$app->db->beginTransaction();

                $order->status = ObmenkaOrder::FINISH;

                if ($order->pay_info == ObmenkaOrder::BUY_VIP){

                    $vipForm = new BuyVipStatusForm();

                    $vipForm->user_id = $user->id;

                    $vipForm->sum = (int) $data->amount;

                    $vipForm->save();

                }else{

                    $user->cash = $user->cash + (int) $data->amount;

                }

                if ($user->save() and $order->save()) {

                    $transaction->commit();

                    Yii::$app->session->setFlash('success', 'Оплата совершена успешно');

                    return  $this->redirect($protocol.'://'.$user->city.'.'.Yii::$app->params['site_name']);

                }

                else{

                    $transaction->rollBack();

                    Yii::$app->session->setFlash('warning', 'Ошибка');

                    return  $this->redirect($protocol.'://'.$user->city.'.'.Yii::$app->params['site_name']);

                }

            }

        }

        return  $this->redirect($protocol.'://msk.'.Yii::$app->params['site_name']);

    }
}