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

    public function actionIndex()
    {
        if (Yii::$app->request->isPost){

            if (!CashHelper::enoughCash(Yii::$app->params['vip_status_week_price'], Yii::$app->user->identity['cash'])){

                Yii::$app->session->setFlash('warning', 'Недостаточно средств для покупки');

                return $this->redirect(Yii::$app->request->referrer);

            }

            $vipForm = new BuyVipStatusForm();

            $vipForm->load(Yii::$app->request->post());

            $vipForm->user_id = Yii::$app->user->id;

            $transaction  = Yii::$app->db->beginTransaction();

            if ($vipForm->validate() and $vipForm->save() and CashHelper::babloSpiz(Yii::$app->user->identity, Yii::$app->params['vip_status_week_price'] )){

                $transaction->commit();

                Yii::$app->session->setFlash('success', 'Досуг VIP Подключен');

            }else{

                $transaction->rollBack();

                Yii::$app->session->setFlash('warning', 'Произошла ошибка');

            }

            return $this->redirect(Yii::$app->request->referrer);

        }

    }

    public function actionGift()
    {
        if (Yii::$app->request->isPost){

            if (!CashHelper::enoughCash(Yii::$app->params['vip_status_week_price'], Yii::$app->user->identity['cash'])){

                Yii::$app->session->setFlash('warning', 'Недостаточно средств для покупки');

                return $this->redirect(Yii::$app->request->referrer);

            }

            $vipForm = new GiftVipStatusForm();

            $vipForm->load(Yii::$app->request->post());

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