<?php


namespace frontend\components\helpers;


use common\models\Presents;
use common\models\User;
use frontend\models\forms\BuyPresentForm;
use Yii;

class GiftHelper
{
    public static function gift(User $user, BuyPresentForm $model)
    {

        if ($presentInfo = Presents::find()->where(['id' => $model->present_id ])->asArray()->one()){

            if (CashHelper::enoughCash($presentInfo['price'], $user->cash )){

                $transaction = Yii::$app->db->beginTransaction();

                if (CashHelper::babloSpiz($user, $presentInfo['price']) and $model->save()){

                    $transaction->commit();

                    return true;

                }
                else{
                    $transaction->rollBack();

                    return false;
                }

            }else{
                return 'Недостаточно средств';
            }

        }

        return 'Ошибка';
    }
}