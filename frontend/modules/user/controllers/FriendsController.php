<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\components\helpers\FriendsHelper;
use frontend\modules\user\components\helpers\FriendsRequestHelper;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\FriendsRequest;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class FriendsController extends Controller
{

    public function actionAdd($city)
    {
        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost){

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
    public function actionRemoveRequest($city)
    {
        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost and FriendsRequestHelper::isFiendsRequest(Yii::$app->request->post('id'), Yii::$app->user->id)){

            return FriendsRequestHelper::removeFriendsRequest(Yii::$app->request->post('id'), Yii::$app->user->id);

        }
        return $this->goHome();
    }
    public function actionRemoveSendRequest($city)
    {
        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost and FriendsRequestHelper::isFiendsRequest(Yii::$app->user->id, Yii::$app->request->post('id') )){

            return FriendsRequestHelper::removeFriendsRequest( Yii::$app->user->id, Yii::$app->request->post('id'));

        }
        //return $this->goHome();
    }
    public function actionRemoveFriend($city)
    {
        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost and FriendsHelper::isFiends(Yii::$app->request->post('id'), Yii::$app->user->id)){

            return FriendsHelper::deleteFriend(Yii::$app->request->post('id'), Yii::$app->user->id);

        }
        return $this->goHome();
    }

    public function actionCheck(){

        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost){

            if (FriendsHelper::confirmFriendship(Yii::$app->request->post('id'), Yii::$app->user->id)) return 'Заявка подтверждена';

            return 'Ошибка';

        }

        return $this->goHome();

    }

    public function actionList($city, $id)
    {
        $userFriends = Friends::find()->where(['user_id' => $id])->with('friendsProfiles')->asArray()->all();

        $userFriendsRequest = FriendsRequest::find()->where(['user_id' => $id])->with('friendsProfiles')->asArray()->all();

        $sendUserFriendsRequest = FriendsRequest::find()->where(['request_user_id' => $id])->with('sendFriendsProfiles')->asArray()->all();

        $userName = Profile::find()->where(['id' => $id])->asArray()->select('id,username')->one();

        $countFriendsRequest = FriendsRequest::find()->where(['user_id' => $id])->count();

        $countUserSendFriendsRequest = FriendsRequest::find()->where(['request_user_id' => $id])->count();

        return $this->render('list', [
            'userFriends' => $userFriends,
            'userFriendsRequest' => $userFriendsRequest,
            'city' => $city,
            'userName' => $userName,
            'countFriendsRequest' => $countFriendsRequest,
            'sendUserFriendsRequest' => $sendUserFriendsRequest,
            'countUserSendFriendsRequest' => $countUserSendFriendsRequest,
        ]);
    }
}