<?php


namespace console\controllers;

use frontend\models\UserPol;
use frontend\modules\user\models\Profile;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class AddController extends Controller
{
    public function actionAddDescription()
    {
        $user_ids = ArrayHelper::getColumn(UserPol::find()->where(['pol_id' => 1])->select('user_id')->asArray()->all(), 'user_id');

        $users_with_not_text = Profile::find()->where(['text' => ''])->andWhere(['in', 'id', $user_ids])->all();

        $users_with_text = ArrayHelper::getColumn(Profile::find()->where(['!=', 'text', ''])->andWhere(['in', 'id', $user_ids])->select('text')->asArray()->all(), 'text');

        foreach ($users_with_not_text as $item){

            $item->text = $users_with_text[\array_rand($users_with_text)];

            $item->save();

        }


    }
}