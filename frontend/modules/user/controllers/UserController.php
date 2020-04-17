<?php

namespace frontend\modules\user\controllers;
use frontend\modules\user\models\Friends;
use frontend\modules\user\models\Profile;
use Yii;


class UserController extends \yii\web\Controller
{

    public $layout = '@app/views/layouts/main-cabinet.php';

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

}
