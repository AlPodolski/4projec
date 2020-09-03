<?php

namespace frontend\modules\user\controllers;
use frontend\modules\user\models\forms\PayForm;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Profile;
use Yii;


class UserController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
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

        return $this->render('index', [
            'model' => $model,
            'city' => $city,
            'userFriends' => $userFriends,
        ]);

    }

    public function actionBalance($city)
    {

        $payForm = new PayForm();


        if ($payForm->load(Yii::$app->request->post()) and $payForm->validate()){

            if ($payForm->sum > 199){

                $order_id = Yii::$app->user->id.'_'.$city;

                $sign = \md5(Yii::$app->params['merchant_id'].':'.$payForm->sum.':'.Yii::$app->params['fk_merchant_key'].':'.$order_id);

                $cassa_url = 'https://www.free-kassa.ru/merchant/cash.php?';

                $params = 'm='.Yii::$app->params['merchant_id'].
                    '&oa='.$payForm->sum.
                    '&o='.$order_id.
                    '&s='.$sign;

                Yii::$app->response->redirect($cassa_url.$params, 301, false);

            }else{

                Yii::$app->session->setFlash('warning', 'Минимальная сумма пополнения 200 рублей');

            }

        }

        return $this->render('balance', [
            'city' => $city,
            'payForm' => $payForm,
        ]);
    }

}
