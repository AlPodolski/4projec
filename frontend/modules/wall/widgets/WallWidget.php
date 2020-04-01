<?php

namespace frontend\modules\wall\widgets;

use frontend\modules\wall\models\Wall;
use Yii;
use yii\base\Widget;

class WallWidget extends Widget
{

    public $user_id;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $wallItems = Wall::find()->where(['user_id' => $this->user_id])->limit(Yii::$app->params['wall_items_limit'])->with('author')->with('comments')->asArray()->all();

        return $this->render('wall', [
            'wallItems' => $wallItems,
        ]);

    }
}