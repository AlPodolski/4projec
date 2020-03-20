<?php


namespace frontend\controllers;

use common\models\Presents;
use frontend\models\forms\BuyPresentForm;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class PresentController extends Controller
{
    public function actionForm($city)
    {
        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $model = new BuyPresentForm();

                $present = Presents::find()->where(['id' => Yii::$app->request->post('present_id')])->asArray()->one();
                $giftForUser = Profile::find()->where(['id' => Yii::$app->request->post('user_id')])->one();

                $user = Yii::$app->user->identity;

                return $this->renderFile('@app/views/present/buy_present.php', [
                    'present' => $present,
                    'from_user_id' => $user,
                    'model' => $model,
                    'giftForUser' => $giftForUser,
                ]);

            }else{
                echo 'Требуется авторизация';
                exit();
            }

        }else {
            echo 'Не' ;
            exit();
        }
    }
}