<?php


namespace frontend\controllers;

use common\models\City;
use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\Group;
use frontend\modules\user\components\behavior\LastVisitTimeUpdate;
use frontend\modules\user\components\helpers\GuestHelper;
use frontend\modules\user\models\Profile;
use frontend\modules\user\models\UserHeart;
use Yii;
use yii\web\Controller;
use frontend\modules\user\models\Photo;

class AnketController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors1()
    {

        if (Yii::$app->user->isGuest){
            return [
                [
                    'class' => 'yii\filters\PageCache',
                    'duration' => 3600 * 24 * 7,
                    'variations' => [
                        \Yii::$app->request->url,
                    ],
                ],
            ];
        }else{
            return [
                LastVisitTimeUpdate::class,
            ];
        }
    }

    public function actionView($city, $id){

        if (Yii::$app->user->isGuest){

            $model = Yii::$app->cache->get(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id.'_guest');

            if ($model === false) {
                // $data нет в кэше, вычисляем заново
                $model = Profile::find()->where(['id' => $id])
                    ->with('ves')
                    ->with('rost')
                    ->with('sexual')
                    ->with('place')
                    ->with('wantFind')
                    ->with('smoking')
                    ->with('alcogol')
                    ->limit(1)
                    ->one();
                // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
                Yii::$app->cache->set(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id.'_guest', $model);
            }

        }else{
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
                    ->limit(1)
                    ->one();
                // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
                Yii::$app->cache->set(Yii::$app->params['cache_name']['detail_profile_cache_name'].$id, $model);
            }
        }

        if (!Yii::$app->user->isGuest and Yii::$app->user->id != $model['id']){

            GuestHelper::addGuest(Yii::$app->user->id, $model['id']);

        }


        $cityInfo = Yii::$app->cache->get(Yii::$app->params['cache_name']['city_info'].$model['city']);

        if ($cityInfo === false) {
            // $data нет в кэше, вычисляем заново
            $cityInfo = City::find()->where(['url' => $model['city']])->asArray()->one();

            Yii::$app->cache->set(Yii::$app->params['cache_name']['city_info'].$model['city'], $cityInfo);

        }

        $userFriends = false;
        $group = false;
        $userHeart = false;

        if (!Yii::$app->user->isGuest){

            $userFriends = Profile::find()
                ->where(['in', 'id', \frontend\modules\user\components\Friends::getFriendsIds($id) ])
                ->select('id, username')
                ->limit(6)
                ->with('userAvatarRelations')
                ->asArray()->all();

            $userGroupId = SubscribeHelper::getUserSubscribe($id, Yii::$app->params['user_group_subscribe_key']);

            $group = Group::find()->where(['in', 'id', $userGroupId])->with('avatar')->limit(6)->asArray()->all();

            $userHeart = UserHeart::find()->where(['whom' => $model->id])->with('buyer')->asArray()->one();

        }

        return $this->render('single' , [
            'model' => $model,
            'city' => $city,
            'cityInfo' => $cityInfo,
            'userFriends' => $userFriends,
            'group' => $group,
            'userHeart' => $userHeart,
        ]);

    }

    public function actionMore($city)
    {

        if (Yii::$app->request->isPost){

            $data = \explode(',' , Yii::$app->request->post('id'));

            // $data нет в кэше, вычисляем заново
            $model = Profile::find()
                ->where(['not in' , 'id', $data])
                ->with('ves')
                ->with('rost')
                ->with('sexual')
                ->with('place')
                ->with('wantFind')
                ->with('smoking')
                ->with('alcogol')
                ->limit(1)
                ->orderBy(" RAND() ")
                ->one();

            $photo = Photo::getUserphoto($model->id);

            return $this->renderFile('@app/views/anket/more.php', [
                'model' => $model,
                'photo' => $photo
            ]);

        }

        return $this->goHome();
    }

}