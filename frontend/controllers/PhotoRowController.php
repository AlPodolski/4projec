<?php


namespace frontend\controllers;

use frontend\components\helpers\CashHelper;
use frontend\modules\user\models\Popular;
use frontend\modules\user\models\Profile;
use Yii;
use yii\web\Controller;

class PhotoRowController extends Controller
{
    public function actionGetForm()
    {
        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $photoRowForm = new Popular();

                $user = Profile::find()->where(['id' => Yii::$app->user->id])->with('avatarRelation')->asArray()->one();

                return $this->renderFile('@app/views/photo-row/photo-row-form.php', [
                    'photoRowForm' => $photoRowForm,
                    'user' => $user,
                ]);

            }
            
            return 'Требуется авторизация';

        }

        return $this->goHome();
    }

    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {

            if (!Yii::$app->user->isGuest) {

                $photoRowForm = new Popular();

                $profile = Profile::findOne(Yii::$app->user->id);

                if ($photoRowForm->load(Yii::$app->request->post()) and $photoRowForm->user_id == Yii::$app->user->id ){

                    if ($profile->cash < Yii::$app->params['photo_row_pay']) {

                        Yii::$app->session->setFlash('danger' , 'Недостаточно средств');

                        return $this->goHome();

                    }

                    $photoRowForm->created_at = \time();

                    if ($photoRowForm->save()) {

                        CashHelper::babloSpiz(Yii::$app->user->identity, Yii::$app->params['photo_row_pay'] );

                        Yii::$app->session->setFlash('success' , 'Анкета добавлена');

                        return $this->goHome();
                    }

                }else{
                    Yii::$app->session->setFlash('danger' , 'Ошибка');

                    return $this->goHome();

                }

            }

            Yii::$app->session->setFlash('danger' , 'Требуется авторизация');

            return $this->goHome();
        }
    }
}