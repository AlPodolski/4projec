<?php


namespace frontend\modules\user\controllers;

use frontend\modules\user\components\helpers\DropCacheHelper;
use frontend\modules\user\components\helpers\TimeHelper;
use frontend\modules\user\models\forms\Params;
use frontend\modules\user\models\forms\PrivateSettingsForm;
use frontend\modules\user\models\Profile;
use yii\web\Controller;
use Yii;

class EditController extends Controller
{

    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionEditProfile($city){

        $model = Profile::findOne(Yii::$app->user->id);

        if (Yii::$app->request->isPost){

            $data = Yii::$app->request->post();

            $data['Profile']['birthday'] = TimeHelper::getTimestampFromString($data['Profile']['birthday']) + 3600 * 12;

            if ($model->load($data) and $model->save()) {

                Yii::$app->session->setFlash('success', "Данные обновлены");

                DropCacheHelper::dropUser($model->id);

                return $this->redirect('/user');
            }else{
                Yii::$app->session->setFlash('warning', "Ошибка");
            }

        }

        return $this->render('edit_profile', [
            'model' => $model,
        ] );

    }

    public function actionPrivate($city)
    {

        $model  = new PrivateSettingsForm();

        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) and $model->save()){

            Yii::$app->session->setFlash('success', "Данные обновлены");

            return $this->redirect('/user');

        }

        return $this->render('private', [
            'model' => $model
        ]);
    }

    public function actionEditAnket($city){

        $model = new Params();

        if (Yii::$app->request->isPost){

            $data = Yii::$app->request->post();

            if ($model->load($data) and $model->save(Yii::$app->user->id, Yii::$app->user->identity->city)) {

                Yii::$app->session->setFlash('success', "Информация обновлена");

                return $this->redirect('/user');

            }else{

                Yii::$app->session->setFlash('warning', "Ошибка");

            }

        }

        return $this->render('edit_anket' , [
            'model' => $model
        ] );

    }
}