<?php


namespace frontend\modules\user\controllers;

use frontend\components\helpers\CashHelper;
use frontend\modules\user\models\forms\BuyUserHeartForm;
use frontend\modules\user\models\Photo;
use Yii;
use yii\web\Controller;

class HeartController extends Controller
{
    public function actionGetForm()
    {
        if (Yii::$app->request->isPost){

            $buyer = Yii::$app->user->id;
            $userWhoHeartIsBuy = (int) Yii::$app->request->post('userWhoHeartIsBuy');

            if($buyer != $userWhoHeartIsBuy) {

                $model = new BuyUserHeartForm();

                $ava = Photo::getAvatar($userWhoHeartIsBuy);

                return $this->renderFile(Yii::getAlias('@frontend/modules/user/views/heart/buyUserHeartForm.php'), [
                    'model'             => $model,
                    'ava'               => $ava,
                    'userWhoHeartIsBuy' => $userWhoHeartIsBuy
                ]);

            }

        }

        return $this->goHome();

    }

    public function actionBuy()
    {
        $model = new BuyUserHeartForm();

        if ($model->load(Yii::$app->request->post())){

            $model->buyer = Yii::$app->user->id;
            $model->timestamp = \time();

            //buy_heart_cost

            if (CashHelper::enoughCash(Yii::$app->params['buy_heart_cost'], Yii::$app->user->identity['cash'] )){

                $transaction = Yii::$app->db->beginTransaction();

                if (CashHelper::babloSpiz(Yii::$app->user->identity, Yii::$app->params['buy_heart_cost']) and $presentId = $model->save()){

                    $transaction->commit();

                    Yii::$app->session->setFlash('success' , 'Сердце занято!');

                    return $this->redirect(Yii::$app->request->referrer);

                }
                else{

                    Yii::$app->session->setFlash('warning' , 'Ошибка');

                    $transaction->rollBack();

                    return $this->redirect(Yii::$app->request->referrer);
                }

            }else{

                Yii::$app->session->setFlash('warning' , 'Ошибка');

                return $this->redirect(Yii::$app->request->referrer);
            }

        }

        return $this->redirect(Yii::$app->request->referrer);

    }

}