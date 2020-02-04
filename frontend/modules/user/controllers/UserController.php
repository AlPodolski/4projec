<?php

namespace frontend\modules\user\controllers;

use frontend\modules\user\models\forms\SignupForm;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($city)
    {
        $model = new SignupForm();

        $model->city = $city;

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Регистрация прошла успешно, проверьте свой Email');
            return $this->redirect('/profile');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}
