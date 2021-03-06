<?php

namespace frontend\modules\wall\controllers;

use frontend\modules\user\models\Profile;
use frontend\modules\wall\components\WallHelper;
use frontend\modules\wall\models\forms\AddToWallForm;
use Yii;
use yii\web\Controller;
use frontend\modules\wall\components\LikeHelper;

class WallController extends Controller
{
    public function actionAdd(){

        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $model = new AddToWallForm();

                $model->from = Yii::$app->user->id;
                $model->created_at = \time();
                $model->class = Profile::class;

                if ($model->load(Yii::$app->request->post()) and $wallItem[] = (array) $model->save()){

                    echo $this->renderFile('@app/modules/wall/views/wall/item.php', [
                        'wallItem' => $wallItem
                    ]);

                    exit();

                }

            }

        }

        return $this->goHome();

    }

    public function actionItemLike()
    {

        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                return LikeHelper::like(Yii::$app->user->id, Yii::$app->request->post('id'), Yii::$app->params['wall_item_redis_key']);

            }

        }

    }

    public function actionItemDelete()
    {

        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                WallHelper::deleteItem(Yii::$app->user->id, Yii::$app->request->post('id'));

            }

        }

    }
}