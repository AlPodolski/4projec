<?php


namespace frontend\modules\group\controllers;


use frontend\modules\group\models\Group;
use frontend\modules\group\models\relation\UserGroup;
use Yii;
use yii\web\NotFoundHttpException;

class GroupController extends \yii\web\Controller
{

    public function actionIndex($city)
    {
        $group = UserGroup::find()->where(['user_id' => Yii::$app->user->id])->with('group')->asArray()->all();

        return $this->render('index', [
            'group' => $group
        ]);
    }

    public function actionGroup($city, $id)
    {
        if ($group = Group::find()->where(['id' => $id])->with('profile')->asArray()->one()) {

            return $this->render('group', [
                'group' => $group,
            ]);

        }

        throw new NotFoundHttpException();

    }

}