<?php


namespace frontend\modules\sympathy\controllers;

use frontend\modules\sympathy\models\SympathySetting;
use Yii;
use yii\web\Controller;


class SympathyController extends Controller
{
    public function behaviors()
    {
        return [
            \common\behaviors\isAuth::class,
        ];
    }

    public function actionIndex($city)
    {
        return $this->render('index');
    }

    public function actionGetSettings()
    {
        if (Yii::$app->request->isPost){

            $model = SympathySetting::find()->where(['user_id' => Yii::$app->user->id])->one() ?: new SympathySetting();

            return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/form.php'), [
                'model' => $model
            ]);

        }

        return $this->goHome();
    }

    public function actionSetSettings()
    {
        if (Yii::$app->request->isPost){

            $model = SympathySetting::find()->where(['user_id' => Yii::$app->user->id])->one() ?: new SympathySetting();

            if ($model->load(Yii::$app->request->post()) ) {

                $model->user_id = Yii::$app->user->id;

                if (($model->age_from <= $model->age_to) and $model->save())return 'Сохранено';

                return 'Ошибка';

            }

        }

        return $this->goHome();
    }

}