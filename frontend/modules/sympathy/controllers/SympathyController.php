<?php


namespace frontend\modules\sympathy\controllers;

use frontend\models\UserPol;
use frontend\modules\sympathy\components\helpers\AgeHelper;
use frontend\modules\sympathy\models\SympathySetting;
use frontend\modules\user\models\Profile;
use Yii;
use yii\helpers\ArrayHelper;
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

        $sympathySettings = SympathySetting::find()->where(['user_id' => Yii::$app->user->id])->one();

        $post = Profile::find();

        if ($sympathySettings){

            $userPol = ArrayHelper::getColumn(UserPol::find()->where(['pol_id' => $sympathySettings->pol_id])->all(), 'user_id');

            $post->andWhere(['in' , 'id' , $userPol]);

            $age_from = AgeHelper::prepareAge($sympathySettings->age_from);
            $age_to = AgeHelper::prepareAge($sympathySettings->age_to);

            $post->andWhere(['<=', 'birthday' , \time() - $age_from]);
            $post->andWhere(['>=', 'birthday' , \time() - $age_to]);


        }

        $post = $post->one();

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

}