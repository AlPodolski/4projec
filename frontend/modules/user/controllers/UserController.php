<?php

namespace frontend\modules\user\controllers;

use frontend\modules\user\models\Photo;


class UserController extends \yii\web\Controller
{

    public function actionIndex()
    {

        $photo = new Photo();

        return $this->render('index', [
            'photo' => $photo,
        ]);
    }

}
