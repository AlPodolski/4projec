<?php


namespace console\controllers;

use common\models\City;
use common\models\User;
use frontend\models\relation\UserZnakomstva;
use frontend\models\UserPol;
use frontend\models\UserProstitutki;
use frontend\modules\user\models\Profile;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class AddController extends Controller
{
    public function actionAddDescription()
    {
        $user_ids = ArrayHelper::getColumn(UserPol::find()->where(['pol_id' => 2])->select('user_id')->asArray()->all(), 'user_id');

        $users_with_not_text = Profile::find()->where(['text' => ''])->andWhere(['in', 'id', $user_ids])->all();

        $users_with_text = ArrayHelper::getColumn(Profile::find()->where(['!=', 'text', ''])->andWhere(['in', 'id', $user_ids])->select('text')->asArray()->all(), 'text');

        foreach ($users_with_not_text as $item){

            $item->text = $users_with_text[\array_rand($users_with_text)];

            $item->save();

        }

    }

    public function actionAddToZnakom()
    {
        $profilesPr = UserProstitutki::find()->select('user_id')->asArray()->all();

        $users = Profile::find()->where(['not in', 'id', ArrayHelper::getColumn($profilesPr, 'user_id') ])->asArray()->all();

        echo 1;

        foreach ($users as $user){


            if (!UserZnakomstva::find()->where(['user_id' => $user['id']])->asArray()->all()){

                $userZn = new UserZnakomstva();

                $userZn->user_id=  $user['id'];

                $userZn->city_id = ArrayHelper::getValue(City::find()->where(['url' => $user['city']])->asArray()->one(), 'id');
                $userZn->param_id = 1;

                $userZn->save();


            }

        }

    }
}