<?php


namespace frontend\modules\sympathy\controllers;

use frontend\modules\sympathy\components\helpers\SympathyHelper;
use frontend\modules\sympathy\models\SympathySetting;
use frontend\modules\user\models\Profile;
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

        $skip_id = \array_merge(
            SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_like_key']),
            SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_skip_key'])
        );

        $post = SympathyHelper::getProfile(Yii::$app->user->id, $skip_id);

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

                if (($model->age_from <= $model->age_to) and $model->save()) {

                    $skip_id = \array_merge(
                        SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_like_key']),
                        SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_skip_key'])
                    );

                    if($post = SympathyHelper::getProfile(Yii::$app->user->id, $skip_id)){

                        return  $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/item.php'), [
                            'post' => $post
                        ]);

                    }else{
                        return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/no-content.php'));
                    }

                }

                return 'Ошибка';

            }

        }

        return $this->goHome();
    }

    public function actionAdd()
    {

        if (Yii::$app->request->isPost){

            $status = false;

            if (Yii::$app->request->post('action') == 'like'){

                $status = SympathyHelper::add( Yii::$app->user->id, Yii::$app->request->post('id'));

            }
            if (Yii::$app->request->post('action') == 'skip'){

                SympathyHelper::set(Yii::$app->params['users_who_skip_key'], Yii::$app->user->id, Yii::$app->request->post('id'));

            }

            if ($status == SympathyHelper::ADD_MUTUAL_SYMPATHY) {

                return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/mutual.php'), [
                    'posts' => Profile::find()
                        ->where(['in', 'id' , [Yii::$app->user->id, Yii::$app->request->post('id')] ] )
                        ->with('userAvatarRelations')
                        ->asArray()->all(),
                    'likePost' => Yii::$app->request->post('id')
                ]);

            }

            $skip_id = \array_merge(
                SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_like_key']),
                SympathyHelper::get(Yii::$app->user->id, Yii::$app->params['users_who_skip_key'])
            );

            if($post = SympathyHelper::getProfile(Yii::$app->user->id, $skip_id)){

                return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/item.php'), [
                    'post' => $post
                ]);

            }else{
                return $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/no-content.php'));
            }

        }

    }

}