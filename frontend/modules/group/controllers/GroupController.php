<?php


namespace frontend\modules\group\controllers;


use frontend\modules\group\models\Group;
use frontend\modules\group\models\relation\UserGroup;
use Yii;

class GroupController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $group = UserGroup::find()->where(['user_id' => Yii::$app->user->id])->with('group')->asArray()->all();

        return $this->render('index', [
            'group' => $group
        ]);
    }

    public function actionGroup($id)
    {
        $group = Group::find()->where(['id' => $id])->asArray()->one();

        return $this->render('group', [
            'group' => $group,
        ]);
    }

}