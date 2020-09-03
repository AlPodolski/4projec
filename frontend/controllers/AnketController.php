<?php


namespace frontend\controllers;

use common\models\City;
use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\Group;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class AnketController extends Controller
{
    public function actionView($city, $id){

        $model = Yii::$app->cache->get(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id);

        if ($model === false) {
            // $data нет в кэше, вычисляем заново
            $model = Profile::find()->where(['id' => $id])
                ->with('place')
                ->with('sexual')
                ->with('bodyType')
                ->with('national')
                ->with('financialSituation')
                ->with('interesting')
                ->with('professionals')
                ->with('vneshnost')
                ->with('children')
                ->with('family')
                ->with('wantFind')
                ->with('celiZnakomstvamstva')
                ->with('haracter')
                ->with('lifeGoals')
                ->with('smoking')
                ->with('alcogol')
                ->with('education')
                ->with('breast')
                ->with('intimHair')
                ->with('hairColor')
                ->with('sferaDeyatelnosti')
                ->with('zhile')
                ->with('transport')
                ->with('ves')
                ->with('rost')
                ->with('vajnoeVPartnere')
                ->one();
            // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
            Yii::$app->cache->set(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id, $model);
        }

        $userFriends = Profile::find()
            ->where(['in', 'id', \frontend\modules\user\components\Friends::getFriendsIds($id) ])
            ->select('id, username')
            ->limit(6)
            ->with('userAvatarRelations')
            ->asArray()->all();

        $cityInfo = Yii::$app->cache->get(Yii::$app->params['cache_name']['city_info'].$model['city']);

        if ($cityInfo === false) {
            // $data нет в кэше, вычисляем заново
            $cityInfo = City::find()->where(['url' => $city])->asArray()->one();

            Yii::$app->cache->set(Yii::$app->params['cache_name']['city_info'].$model['city'], $cityInfo);

        }

        $userGroupId = SubscribeHelper::getUserSubscribe($id, Yii::$app->params['user_group_subscribe_key']);

        $group = Group::find()->where(['in', 'id', $userGroupId])->with('avatar')->limit(6)->asArray()->all();

        return $this->render('single' , [
            'model' => $model,
            'city' => $city,
            'cityInfo' => $cityInfo,
            'userFriends' => $userFriends,
            'group' => $group,
        ]);

    }
}