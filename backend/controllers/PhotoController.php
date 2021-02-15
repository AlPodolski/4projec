<?php


namespace backend\controllers;

use frontend\modules\user\models\Photo;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PhotoController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'set-main' => ['post'],
                ],
            ],
            \backend\components\behaviors\isAdminAuth::class,
        ];
    }

    public function actionSetMain()
    {

        $userId = Yii::$app->request->post('user_id');

        $photoId = Yii::$app->request->post('photo_id');

        Photo::updateAll(['avatar' => 0], ['user_id' => $userId]);

        Photo::updateAll(['avatar' => 1], ['id' => $photoId]);

        return true;

    }

    public function actionHide()
    {
        $photoId = Yii::$app->request->post('photo_id');

        Photo::updateAll(['status' => 1], ['id' => $photoId]);

        return true;
    }

    public function actionShow()
    {
        $photoId = Yii::$app->request->post('photo_id');

        Photo::updateAll(['status' => 0], ['id' => $photoId]);

        return true;
    }

    public function actionDelete()
    {
        $photoId = Yii::$app->request->post('photo_id');

        $photo = Photo::find()->where(['id' => $photoId])->one();

        @\unlink(Yii::getAlias('@frontend').'/web'.$photo['file']);

        $photo->delete();

        return true;
    }

}