<?php


namespace frontend\modules\group\controllers;


use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\Group;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

class GroupController extends \yii\web\Controller
{

    public function actionIndex($city)
    {

        $userGroupId = SubscribeHelper::getUserSubscribe(Yii::$app->user->id, Yii::$app->params['user_group_subscribe_key']);

        $group = Group::find()->where(['in' , 'id' , $userGroupId])->with('avatar')->asArray()->all();

        return $this->render('index', [
            'group' => $group
        ]);
    }

    public function actionGroup($city, $id)
    {
        if ($group = Group::find()->where(['id' => $id])->with('profile')->with('avatar')->asArray()->one()) {

            $subscribersIds = SubscribeHelper::getGroupSubscribers($id, Yii::$app->params['group_subscribe_key']);

            $subscribers = Profile::find()->where(['in', 'id', $subscribersIds])->with('userAvatarRelations')
                ->limit(6)->asArray()->all();

            $countSubscribes = SubscribeHelper::countSubscribers($id, Yii::$app->params['group_subscribe_key']);

            return $this->render('group', [
                'group' => $group,
                'subscribers' => $subscribers,
                'countSubscribes' => $countSubscribes,
            ]);

        }

        throw new NotFoundHttpException();

    }

    public function actionSubscribe()
    {
        if (Yii::$app->request->isPost and !Yii::$app->user->isGuest){

            SubscribeHelper::Subscribe(
                Yii::$app->request->post('group_id'),
                Yii::$app->user->id,
                Yii::$app->params['group_subscribe_key'],
                Yii::$app->params['user_group_subscribe_key']
            );

            if (SubscribeHelper::isSubscribe(
                Yii::$app->request->post('group_id'),
                Yii::$app->user->id,
                Yii::$app->params['group_subscribe_key'])
            ) return 'Отписаться';

            else return 'Подписаться';

        }

        return $this->goHome();
    }

    public function actionSubscribers($city, $id)
    {


        $subscribersIds = SubscribeHelper::getGroupSubscribers($id, Yii::$app->params['group_subscribe_key']);

        $group = Group::find()->where(['id' => $id])->with('profile')->with('avatar')->asArray()->one();

        $subscribers = Profile::find()->where(['in', 'id', $subscribersIds])->with('userAvatarRelations')
            ->asArray();

        $countQuery = clone $subscribers;

        $pages = new Pagination(['totalCount' => $countQuery->count()]);

        if (Yii::$app->request->isPost){

            $subscribers = $subscribers->limit($pages->limit)
                ->offset($pages->defaultPageSize * Yii::$app->request->post('page'))->all();

            return $this->renderFile(Yii::getAlias('@app/modules/group/views/group/subscribers-more.php'), [
                'subscribers' => $subscribers,
            ]);

        }else{

            $subscribers = $subscribers->limit($pages->limit)->offset($pages->offset);

            $subscribers = $subscribers->all();

            $countSubscribes = SubscribeHelper::countSubscribers($id, Yii::$app->params['group_subscribe_key']);

            return $this->render('subscribers', [
                'subscribers' => $subscribers,
                'group' => $group,
                'countSubscribes' => $countSubscribes,
                'pages' => $pages,
            ]);

        }

    }

}