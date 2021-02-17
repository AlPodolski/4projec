<?php

namespace frontend\modules\user\controllers;
use frontend\components\helpers\CashHelper;
use frontend\models\forms\GetHeartForm;
use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\Group;
use frontend\modules\user\components\behavior\LastVisitTimeUpdate;
use frontend\modules\user\models\forms\PayForm;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Profile;
use frontend\modules\user\models\UserHeart;
use Yii;


class UserController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
            LastVisitTimeUpdate::class,
        ];
    }


    public function actionIndex($city)
    {
        if (Yii::$app->user->isGuest) return $this->goHome();

        $model = Profile::find()->where(['id' => Yii::$app->user->id])->one();

        $userFriends = Profile::find()
            ->where(['in', 'id', \frontend\modules\user\components\Friends::getFriendsIds(Yii::$app->user->id) ])
            ->select('id, username')
            ->with('userAvatarRelations')
            ->limit(6)
            ->asArray()->all();

        $userGroupId = SubscribeHelper::getUserSubscribe(Yii::$app->user->id, Yii::$app->params['user_group_subscribe_key']);

        $group = Group::find()->where(['in', 'id', $userGroupId])->limit(6)->with('avatar')->asArray()->all();

        $userHeart = UserHeart::find()->where(['whom' => $model->id])->with('buyer')->asArray()->one();

        return $this->render('index', [
            'model' => $model,
            'city' => $city,
            'userFriends' => $userFriends,
            'group' => $group,
            'userHeart' => $userHeart,
        ]);

    }

    public function actionBalance($city)
    {

        $payForm = new PayForm();


        if ($payForm->load(Yii::$app->request->post()) and $payForm->validate()){

            if ($payForm->sum > (Yii::$app->params['min_sum_pay'] - 1)){

                $order_id = Yii::$app->user->id.'_'.$city;

                $sign = \md5(Yii::$app->params['merchant_id'].':'.$payForm->sum.':'.Yii::$app->params['fk_merchant_key'].':'.$order_id);

                $email = Yii::$app->user->identity->email;

                $cassa_url = 'https://www.free-kassa.ru/merchant/cash.php?';

                $params = 'm='.Yii::$app->params['merchant_id'].
                    '&oa='.$payForm->sum.
                    '&o='.$order_id.
                    '&email='.$email.
                    '&s='.$sign;

                Yii::$app->response->redirect($cassa_url.$params, 301, false);

            }else{

                Yii::$app->session->setFlash('warning', 'Минимальная сумма пополнения '.Yii::$app->params['min_sum_pay'].' рублей');

            }

        }

        return $this->render('balance', [
            'city' => $city,
            'payForm' => $payForm,
        ]);
    }

    public function actionBuyHeart()
    {
        $model = new GetHeartForm();

        if (!Yii::$app->user->isGuest and $model->load(Yii::$app->request->post())){

            if (!CashHelper::enoughCash(Yii::$app->params['get_heart_status_week_price'], Yii::$app->user->identity['cash'])){

                Yii::$app->session->setFlash('warning', 'Недостаточно средств для покупки');

                return $this->redirect(Yii::$app->request->referrer);

            }

            $transaction = Yii::$app->db->beginTransaction();

            if ($model->save() and CashHelper::babloSpiz(Yii::$app->user->identity, Yii::$app->params['get_heart_status_week_price'] )){

                $transaction->commit();

                Yii::$app->session->setFlash('warning', 'Сердце занято');

                return $this->redirect(Yii::$app->request->referrer);

            }else{

                $transaction->rollBack();

                Yii::$app->session->setFlash('warning', 'Ошибка');

                return $this->redirect(Yii::$app->request->referrer);

            }

        }

        return $this->goHome();

    }

}
