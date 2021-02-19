<?php


namespace frontend\controllers;

use frontend\components\helpers\CashHelper;
use frontend\models\forms\BuyVipStatusForm;
use Yii;
use yii\web\Controller;
use frontend\models\forms\GiftVipStatusForm;

class VipController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {
        if (Yii::$app->request->isPost){

            $vipForm = new BuyVipStatusForm();

            $vipForm->load(Yii::$app->request->post());

            $vipForm->user_id = Yii::$app->user->id;

            if (!CashHelper::enoughCash($vipForm->sum, Yii::$app->user->identity['cash'])){

                $order_id = Yii::$app->user->id.'_'.$city.'_vip';

                $sign = \md5(Yii::$app->params['merchant_id'].':'.$vipForm->sum.':'.Yii::$app->params['fk_merchant_key'].':'.$order_id);

                $cassa_url = 'https://www.free-kassa.ru/merchant/cash.php?';

                $email = Yii::$app->user->identity->email;

                $params = 'm='.Yii::$app->params['merchant_id'].
                    '&oa='.$vipForm->sum.
                    '&o='.$order_id.
                    '&email='.$email.
                    '&s='.$sign;

                return Yii::$app->response->redirect($cassa_url.$params, 301, false);

            }

            $transaction  = Yii::$app->db->beginTransaction();

            if ($vipForm->validate() and $vipForm->save() and CashHelper::babloSpiz(Yii::$app->user->identity, $vipForm->sum)){

                $transaction->commit();

                Yii::$app->session->setFlash('success', 'Досуг VIP Подключен');

            }else{

                $transaction->rollBack();

                Yii::$app->session->setFlash('warning', 'Произошла ошибка');

            }

            return $this->redirect(Yii::$app->request->referrer);

        }

    }

    public function actionGift($city)
    {
        if (Yii::$app->request->isPost){

            $vipForm = new GiftVipStatusForm();

            $vipForm->load(Yii::$app->request->post());

            if (!CashHelper::enoughCash(Yii::$app->params['vip_status_week_price'], Yii::$app->user->identity['cash'])){

                $order_id = Yii::$app->user->id.'_'.$city.'_vipgift_'.$vipForm->toUser;

                $sign = \md5(Yii::$app->params['merchant_id'].':'.Yii::$app->params['vip_status_week_price'].':'.Yii::$app->params['fk_merchant_key'].':'.$order_id);

                $cassa_url = 'https://www.free-kassa.ru/merchant/cash.php?';

                $email = Yii::$app->user->identity->email;

                $params = 'm='.Yii::$app->params['merchant_id'].
                    '&oa='.Yii::$app->params['vip_status_week_price'].
                    '&o='.$order_id.
                    '&email='.$email.
                    '&s='.$sign;

                return Yii::$app->response->redirect($cassa_url.$params, 301, false);

            }

            $vipForm->fromUser = Yii::$app->user->id;

            $transaction  = Yii::$app->db->beginTransaction();

            if ($vipForm->validate() and $vipForm->save() and CashHelper::babloSpiz(Yii::$app->user->identity, Yii::$app->params['vip_status_week_price'] )){

                $transaction->commit();

                Yii::$app->cache->delete(Yii::$app->params['cache_name']['detail_profile_cache_name'].$vipForm->toUser);

                Yii::$app->session->setFlash('success', 'Досуг VIP Подарен');

            }else{

                $transaction->rollBack();

                Yii::$app->session->setFlash('warning', 'Произошла ошибка');

            }

            return $this->redirect(Yii::$app->request->referrer);

        }

    }
}