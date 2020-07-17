<?php


namespace frontend\components\helpers;


use common\models\Presents;
use common\models\User;
use frontend\models\forms\BuyPresentForm;
use frontend\models\relation\UserPresents;
use frontend\modules\chat\models\forms\SendMessageForm;
use frontend\modules\chat\models\Message;
use frontend\modules\chat\models\relation\UserDialog;
use Yii;
use yii\helpers\ArrayHelper;

class GiftHelper
{
    public static function gift(User $user, BuyPresentForm $model)
    {

        if ($presentInfo = Presents::find()->where(['id' => $model->present_id ])->asArray()->one()){

            if (CashHelper::enoughCash($presentInfo['price'], $user->cash )){

                $transaction = Yii::$app->db->beginTransaction();

                if (CashHelper::babloSpiz($user, $presentInfo['price']) and $presentId = $model->save()){

                    $transaction->commit();

                    return $presentId;

                }
                else{
                    $transaction->rollBack();

                    return false;
                }

            }else{

                throw new \Exception('Недостаточно средств');

            }

        }

        throw new \Exception('Ошибка');

    }

    public static function send_message($present_id, $from, $to){

        $toId = ArrayHelper::getColumn(UserDialog::find()->where(['user_id' => $to])->asArray()->all(), 'dialog_id');

        $fromDialogs = UserDialog::find()->where(['in', 'dialog_id', $toId ])->andWhere(['user_id' => $from])->asArray()->one();

        $model  = new SendMessageForm();

        $model->related_id = $present_id;
        $model->class = UserPresents::class;
        $model->from_id = $from;
        if ($fromDialogs) $model->chat_id = $fromDialogs['dialog_id'];
        $model->created_at = \time();

        return $model->save();

    }

}