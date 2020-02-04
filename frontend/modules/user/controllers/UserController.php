<?php

namespace frontend\modules\user\controllers;

use common\models\LoginForm;
use frontend\modules\user\models\forms\SignupForm;
use Yii;
use yii\filters\VerbFilter;

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
            return $this->redirect('/');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Logs in a user.
     * @param $city string
     * @return mixed
     */
    public function actionLogin($city)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        $model->city = $city;

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/user');
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

}
