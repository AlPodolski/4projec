<?php


namespace chat\controllers;

use common\models\Presents;
use frontend\components\helpers\GiftHelper;
use frontend\components\helpers\SocketHelper;
use frontend\models\forms\BuyPresentForm;
use Yii;
use yii\web\Controller;

class PresentController extends Controller
{
    public function actionForm($city)
    {

        if (!Yii::$app->user->isGuest) {

            $model = new BuyPresentForm();

            $present = Presents::find()->where(['id' => Yii::$app->request->post('present_id')])->asArray()->one();
            $giftForUser = Yii::$app->request->post('user_id');

            return $this->renderFile('@app/views/present/buy_present.php', [
                'present' => $present,
                'from_user_id' => Yii::$app->request->post('user_from_id'),
                'model' => $model,
                'giftForUser' => $giftForUser,
            ]);

        }

        return true;

    }

    public function actionGift($city)
    {

        if (!Yii::$app->user->isGuest) {

            if (Yii::$app->request->isPost) {

                $model = new BuyPresentForm();

                $model->from_id = Yii::$app->request->post('from');
                $model->to_id = Yii::$app->request->post('to');
                $model->present_id = Yii::$app->request->post('present_id');
                $model->message = Yii::$app->request->post('message');

                if ($present_id = $model->save()){

                    GiftHelper::send_message($present_id, $model->from_id, $model->to_id);

                    $params = array(
                        'present_id' => $present_id,
                        'action' => 'sendPresent',
                    );

                    SocketHelper::send_notification($params);

                }

                return 'Подарок отправлен';

            }

        }

    }

    public function actionPresents()
    {
        if (Yii::$app->request->isPost) {

            return $this->renderFile('@app/views/present/present.php');

        }

        return $this->goHome();
    }
}