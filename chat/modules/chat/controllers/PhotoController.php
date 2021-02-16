<?php


namespace chat\modules\chat\controllers;

use frontend\models\Files;
use frontend\modules\chat\models\forms\SendPhotoForm;
use frontend\modules\chat\models\Message;
use frontend\modules\user\models\Photo;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PhotoController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            \backend\components\behaviors\isAdminAuth::class,
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-gallery' => ['POST'],
                    'send' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGetGallery()
    {

        $id = Yii::$app->request->post('id');//id пользователя чью фото получаем

        $chat_id = Yii::$app->request->post('chat_id');

        $photo = Photo::find()->where(['user_id' => $id])->asArray()->all();

        return $this->renderFile(Yii::getAlias('@app/modules/chat/views/photo/get-gallery.php'), [
            'photo' => $photo,
            'id' => $id,
            'chat_id' => $chat_id,
        ]);

    }

    public function actionSend()
    {

        $from = Yii::$app->request->post('from');
        $img_id = Yii::$app->request->post('img_id');
        $chat_id = Yii::$app->request->post('chat_id');

        $photo = Photo::findOne($img_id);

        $file = new Files();

        $file->related_class = Message::class;

        $file->file = $photo['file'];

        $file->save();

        $sendMessageForm = new SendPhotoForm();

        $sendMessageForm->user_id = $from;
        $sendMessageForm->dialog_id = $chat_id;
        $sendMessageForm->photo_id = $file->id;

        $sendMessageForm->save();

        echo \json_encode(array('img' => 'http://msk.'.Yii::$app->params['site_name'] . $file->file));

        exit();

    }

}