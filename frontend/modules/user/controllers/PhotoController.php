<?php


namespace frontend\modules\user\controllers;
use frontend\modules\user\components\helpers\ImageHelper;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use frontend\modules\user\models\Photo;
use frontend\modules\user\components\helpers\DirHelprer;

class PhotoController extends Controller
{
    public function actionUpload(){

        $model = new Photo();

        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost){

            $file = UploadedFile::getInstance($model, 'file');

            $model->file = 'photo-'.Yii::$app->user->id.'-'.\md5($file->name).\time();

            $dir = Yii::$app->params['photo_path'].DirHelprer::generateDirNameHash($model->file).'/';

            $save_dir = DirHelprer::prepareDir(Yii::getAlias('@webroot').$dir);

            ImageHelper::prepareImage($file, $model, $save_dir, $model->file.'.jpg');

            return  $dir.$model->file.'.jpg';

        }

    }
}