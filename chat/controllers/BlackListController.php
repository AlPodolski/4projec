<?php


namespace chat\controllers;

use common\models\BlackList;
use common\models\Presents;
use frontend\models\forms\BuyPresentForm;
use Yii;
use yii\web\Controller;

class BlackListController extends Controller
{
    public function actionAdd()
    {
        if (!Yii::$app->user->isGuest) {

            $userId = Yii::$app->request->post('user_id');

            if (!BlackList::find()->where(['user_id' => $userId])->one()){

                $blackList = new BlackList;

                $blackList->user_id = $userId;

                $blackList->save();

            }

            return $userId;

        }
    }
}