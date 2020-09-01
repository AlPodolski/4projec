<?php


namespace frontend\modules\group\controllers;


use frontend\components\helpers\SaveFileHelper;
use frontend\modules\group\components\helpers\SubscribeHelper;
use frontend\modules\group\models\forms\addGroupRecordItemForm;
use frontend\modules\group\models\Group;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\web\UploadedFile;

class GroupController extends \yii\web\Controller
{

    public function actionIndex($city)
    {
        $userGroupId = SubscribeHelper::getUserSubscribe(Yii::$app->user->id, Yii::$app->params['user_group_subscribe_key']);

        $group = Group::find()->where(['in', 'id', $userGroupId])->with('avatar')->asArray()->all();

        $recomendGroup = Group::find()->limit(6)->orderBy(['rand()' => SORT_DESC])->with('profile')->with('avatar')->asArray()->all();

        return $this->render('index', [
            'group' => $group,
            'recomendGroup' => $recomendGroup,
        ]);
    }

    public function actionGroup($city, $id)
    {
        if ($group = Group::find()->where(['id' => $id])->with('profile')->with('avatar')->asArray()->one()) {

            if (Yii::$app->request->isPost) {

                return \frontend\modules\wall\widgets\WallWidget::widget([
                    'user_id' => $group['id'],
                    'group' => $group,
                    'relatedClass' => \frontend\modules\group\models\Group::class,
                    'wrapCssClass' => 'm-bottom-20',
                    'offset' => Yii::$app->params['wall_items_limit'] * Yii::$app->request->post('page'),
                ]);

            }

            $model = new addGroupRecordItemForm();

            $subscribersIds = SubscribeHelper::getGroupSubscribers($id, Yii::$app->params['group_subscribe_key']);

            $subscribers = Profile::find()->where(['in', 'id', $subscribersIds])->with('userAvatarRelations')
                ->limit(6)->asArray()->all();

            $countSubscribes = SubscribeHelper::countSubscribers($id, Yii::$app->params['group_subscribe_key']);

            return $this->render('group', [
                'group' => $group,
                'subscribers' => $subscribers,
                'countSubscribes' => $countSubscribes,
                'model' => $model,
            ]);

        }

        throw new NotFoundHttpException();

    }

    public function actionSubscribe()
    {
        if (Yii::$app->request->isPost and !Yii::$app->user->isGuest) {

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
            ) {

                SubscribeHelper::addGroupPostToUserNews(
                    Yii::$app->request->post('group_id'),
                    Yii::$app->user->id,
                    Yii::$app->params['add_elements_to_news_after_subscribe']
                );

                return 'Отписаться';

            }

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

        if (Yii::$app->request->isPost) {

            $subscribers = $subscribers->limit($pages->limit)
                ->offset($pages->defaultPageSize * Yii::$app->request->post('page'))->all();

            return $this->renderFile(Yii::getAlias('@app/modules/group/views/group/subscribers-more.php'), [
                'subscribers' => $subscribers,
            ]);

        } else {

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

    public function actionList($city)
    {
        $group = Group::find()->with('avatar')->asArray()->limit(10);

        if (Yii::$app->request->isPost) {

            $group = $group->limit(10)
                ->offset(10 * Yii::$app->request->post('page'))->all();

            return $this->renderFile(Yii::getAlias('@app/modules/group/views/group/group-more.php'), [
                'group' => $group,
            ]);

        }

        $group = $group->all();

        return $this->render('list', [
            'group' => $group,
        ]);
    }

    public function actionAdd()
    {

        if (!Yii::$app->user->isGuest) {

            $model = new addGroupRecordItemForm();

            if ($model->load(Yii::$app->request->post())  and $group = Group::find()
                ->where(['user_id' => Yii::$app->user->id, 'id' => $model->group_id])->asArray()->one()) {

                $model->class = Group::class;
                $model->user_id = Yii::$app->user->id;

                if ( $model->validate() and $item = $model->save()) {

                    if ($files = UploadedFile::getInstances($model, 'file')) {

                        $resultPhotoItems = array();

                        foreach ($files as $file) {

                            $resultPhotoItems[] = SaveFileHelper::save($file, $group['id'],\frontend\modules\wall\models\Wall::class,  $item['id']);

                        }

                    }

                }

            }

        }

    }
}