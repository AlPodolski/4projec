<?php


namespace backend\controllers;

use chat\modules\chat\models\relation\UserDialog;
use frontend\modules\user\models\Profile;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class RetingMessageController extends Controller
{
    public function behaviors()
    {
        return [
            \backend\components\behaviors\isAdminAuth::class,
        ];
    }

    public function actionIndex()
    {

        $users = Profile::find()->where(['fake' => 0])->asArray()->all();

        $userDialog = UserDialog::find()->select( ['user_id', 'counted' => 'count(*)'])
            ->where(['in', 'user_id', ArrayHelper::getColumn($users, 'id')])
            ->with('user')
            ->orderBy('counted DESC')
            ->groupBy('user_id')
            ->limit(700)
            ->asArray()
            ->all();

        return $this->render('index', [
            'userDialog' => $userDialog
        ] );

    }

}