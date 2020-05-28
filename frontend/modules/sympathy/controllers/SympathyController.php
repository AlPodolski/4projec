<?php


namespace frontend\modules\sympathy\controllers;

use frontend\modules\sympathy\components\helpers\SympathyHelper;
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

        $old_sympathy = SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_like_key']);

        $post = SympathyHelper::getProfile(Yii::$app->user->id, $old_sympathy);

        return $this->render('index', [
            'post' => $post,
        ]);
    }

    public function actionGetSettings()
    {
        if (Yii::$app->request->isPost) {

            $model = SympathySetting::find()->where(['user_id' => Yii::$app->user->id])->one() ?: new SympathySetting();

            return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/form.php'), [
                'model' => $model
            ]);

        }

        return $this->goHome();
    }

    public function actionSetSettings()
    {
        if (Yii::$app->request->isPost) {

            $model = SympathySetting::find()->where(['user_id' => Yii::$app->user->id])->one() ?: new SympathySetting();

            if ($model->load(Yii::$app->request->post())) {

                $model->user_id = Yii::$app->user->id;

                if (($model->age_from <= $model->age_to) and $model->save()) return 'Сохранено';

                return 'Ошибка';

            }

        }

        return $this->goHome();
    }

    public function actionAdd()
    {

        if (Yii::$app->request->isPost){

            SympathyHelper::add(Yii::$app->params['users_who_like_key'], Yii::$app->user->id, Yii::$app->request->post('id'));

            SympathyHelper::add(Yii::$app->params['users_whom_like_key'],Yii::$app->request->post('id'),  Yii::$app->user->id);

        }

        $old_sympathy = SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_like_key']);

        if($post = SympathyHelper::getProfile(Yii::$app->user->id, $old_sympathy)){

            return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/item.php'), [
                'post' => $post
            ]);

        }
    }

}