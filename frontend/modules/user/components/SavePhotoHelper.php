<?php


namespace frontend\modules\user\components;


use frontend\modules\user\components\helpers\DirHelprer;
use frontend\modules\user\components\helpers\ImageHelper;
use frontend\modules\user\models\Photo;
use Yii;
use yii\web\UploadedFile;

class SavePhotoHelper
{
    public static function savePhoto( UploadedFile $file, $isAvatar = 0)
    {

        $model = new Photo();

        $model->file = 'photo-'.Yii::$app->user->id.'-'.\md5($file->name).\time().'.jpg';

        $dir_hash = DirHelprer::generateDirNameHash($model->file).'/';

        $dir = Yii::$app->params['photo_path'].$dir_hash;

        $save_dir = DirHelprer::prepareDir(Yii::getAlias('@webroot').$dir);

        ImageHelper::prepareImage($file, $model, $save_dir, $model->file);

        $model->user_id = Yii::$app->user->id;

        $model->avatar = $isAvatar;

        $model->unsetAvatarStatus();

        $model->file = $dir.$model->file;

        $model->save();

        if ($isAvatar) return $model->file;

        return $model;

    }
}