<?php


namespace frontend\modules\user\controllers;
use frontend\modules\user\components\helpers\DeleteImgHelper;
use frontend\modules\user\components\helpers\ImageHelper;
use frontend\modules\user\components\SavePhotoHelper;
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

            if ($file = UploadedFile::getInstance($model, 'file')){

                return SavePhotoHelper::savePhoto( $file, 1);

            }elseif($files = UploadedFile::getInstances($model, 'file')){

                $resultPhotoItems = array();

                foreach ($files as $file){

                    $resultPhotoItems[] = SavePhotoHelper::savePhoto( $file);

                }

                return $this->renderFile(Yii::getAlias('@app/modules/user/views/photo/upload.php'), [
                    'resultPhotoItems' => $resultPhotoItems
                ]);



            }

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