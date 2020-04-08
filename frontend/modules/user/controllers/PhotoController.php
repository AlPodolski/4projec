<?php


namespace frontend\modules\user\controllers;
use frontend\modules\user\components\helpers\DeleteImgHelper;
use frontend\modules\user\components\helpers\ImageHelper;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use frontend\modules\user\models\Photo;
use frontend\modules\user\components\helpers\DirHelprer;

class PhotoController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {
        $photo = Photo::getUserphoto(Yii::$app->user->id);

        return $this->render('index', [
            'photo' => $photo,
        ]);

    }

    public function actionUpload(){

        $model = new Photo();

        if (!Yii::$app->user->isGuest and Yii::$app->request->isPost){

            $file = UploadedFile::getInstance($model, 'file');

            $model->file = 'photo-'.Yii::$app->user->id.'-'.\md5($file->name).\time().'.jpg';

            $dir_hash = DirHelprer::generateDirNameHash($model->file).'/';

            $dir = Yii::$app->params['photo_path'].$dir_hash;

            $save_dir = DirHelprer::prepareDir(Yii::getAlias('@webroot').$dir);

            ImageHelper::prepareImage($file, $model, $save_dir, $model->file);

            $model->user_id = Yii::$app->user->id;

            $model->avatar = 1;

            $model->unsetAvatarStatus();

            $model->file = $dir.$model->file;

            $model->save();

            return $model->file;

        }

    }

    public function actionDelete(){

        if (Yii::$app->request->isPost){

            $id = Yii::$app->user->id;

            $photoId = Yii::$app->request->post('id');

            DeleteImgHelper::delete($id,$photoId );

            return true;

        }

        return $this->goHome();

    }
}