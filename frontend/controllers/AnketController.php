<?php


namespace frontend\controllers;

use common\models\City;
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
                ->one();
            // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
            Yii::$app->cache->set(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id, $model);
        }

        $userFriends = Friends::find()->where(['user_id' => $model->id])->with('friendsProfiles')->limit(6)->asArray()->all();

        $cityInfo = Yii::$app->cache->get(Yii::$app->params['cache_name']['city_info'].$city);

        if ($cityInfo === false) {
            // $data нет в кэше, вычисляем заново
            $cityInfo = City::find()->where(['url' => $city])->asArray()->one();

            Yii::$app->cache->set(Yii::$app->params['cache_name']['city_info'].$city, $cityInfo);

        }

        return $this->render('single' , [
            'model' => $model,
            'city' => $city,
            'cityInfo' => $cityInfo,
            'userFriends' => $userFriends,
        ]);

    }
}