<?php


namespace frontend\modules\user\components\helpers;


use frontend\modules\user\models\Photo;
use Yii;

class DeleteImgHelper
{
    public static function delete($userId, $imgId)
    {
        if ($photo = Photo::find()->where(['user_id' => $userId])->andWhere(['id' => $imgId])->one() and \unlink(Yii::getAlias('@app'.'/web'.$photo->file))){

            return $photo->delete();

        }

        return false;
    }
}