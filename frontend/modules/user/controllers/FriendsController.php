<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\models\Friends;
use frontend\modules\user\models\FriendsRequest;
use frontend\modules\user\models\Profile;
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

    public function actionList($city, $id)
    {
        $userFriends = Friends::find()->where(['user_id' => $id])->with('friendsProfiles')->asArray()->all();

        $userName = Profile::find()->where(['id' => $id])->asArray()->select('username')->one();

        return $this->render('list', [
            'userFriends' => $userFriends,
            'city' => $city,
            'userName' => $userName,
        ]);
    }
}