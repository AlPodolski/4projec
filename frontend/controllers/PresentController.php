<?php


namespace frontend\controllers;

use common\models\Presents;
use Exception;
use frontend\components\helpers\CashHelper;
use frontend\components\helpers\GiftHelper;
use frontend\components\helpers\SocketHelper;
use frontend\models\forms\BuyPresentForm;
use frontend\models\relation\UserPresents;
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

    public function actionGift($city){

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('success', 'Требуется авторизация!');
            return $this->goHome();
        }

        if (Yii::$app->request->isPost){

            $model = new BuyPresentForm();

            if ($model->load(Yii::$app->request->post()) and $model->validate()){

                try {

                    $present_id = GiftHelper::gift(Yii::$app->user->identity, $model);

                    GiftHelper::send_message($present_id, $model->from_id, $model->to_id);

                    $params = array(
                        'present_id' => $present_id,
                        'action' => 'sendPresent',
                    );

                    SocketHelper::send_notification($params);

                    echo \json_encode(array('result' => $this->renderFile(Yii::getAlias('@app/views/present/send_present_info.php'), [
                        'message' => 'Подарок отправлен'
                    ])));

                }
                catch (\Exception $exception){

                    echo \json_encode(array('result' => $this->renderFile(Yii::getAlias('@app/views/present/send_present_info.php'), [
                        'message' => $exception->getMessage()
                    ])));

                }

            }

        }

        exit();

    }

    public function actionPresents()
    {
        if (Yii::$app->request->isPost){

            return $this->renderFile('@app/views/present/present.php');

        }

        return $this->goHome();
    }

    public function actionUserPresents()
    {

        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost){

            $presents = UserPresents::find()
                ->where(['to' => (int)Yii::$app->request->post('id')])
                ->with('present')
                ->with('author')
                ->asArray()
                ->all();

            return $this->renderFile('@app/views/present/user-present.php', [
                'presents' => $presents
            ]);

        }

        return $this->goHome();
    }
}