<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\models\Friends;
use frontend\modules\user\models\FriendsRequest;
use Yii;
use yii\web\Controller;

class FriendsController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionAdd($city)
    {
        if (Yii::$app->request->isPost){

            if(!Friends::find()->where(['friend_user_id'=> Yii::$app->user->id])->andWhere(['user_id' => Yii::$app->request->post('id')])->one()
                and
                !FriendsRequest::find()->where(['request_user_id'=> Yii::$app->user->id])->andWhere(['user_id' => Yii::$app->request->post('id')])->one()){

                $friendsReq = new FriendsRequest();
                $friendsReq->user_id = (int) Yii::$app->request->post('id');
                $friendsReq->request_user_id = Yii::$app->user->id;

                if ($friendsReq->save()) return 'Заявка отправлена';

            }

        }

        return $this->goHome();
    }
}