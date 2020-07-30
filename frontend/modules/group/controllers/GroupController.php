<?php


namespace frontend\modules\group\controllers;


use frontend\modules\group\models\Group;
use frontend\modules\group\models\GroupItem;
use frontend\modules\group\models\relation\UserGroup;
use Yii;
use yii\web\NotFoundHttpException;

class GroupController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $group = UserGroup::find()->where(['user_id' => Yii::$app->user->id])->with('group')->asArray()->all();

        return $this->render('index', [
            'group' => $group
        ]);
    }

    public function actionGroup($city, $id)
    {
        if ($group = Group::find()->where(['id' => $id])->asArray()->one()) {

            $groupItems = GroupItem::find()->where(['group_id' => $id])->limit(12)->asArray()->all();

            return $this->render('group', [
                'group' => $group,
                'groupItems' => $groupItems,
            ]);

        }

        throw new NotFoundHttpException();

    }

}