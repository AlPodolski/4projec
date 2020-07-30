<?php

namespace frontend\modules\wall\widgets;

use frontend\modules\wall\models\Wall;
use Yii;
use yii\base\Widget;

class WallWidget extends Widget
{

    public $user_id;
    public $group = null;
    public $relatedClass = 'frontend\modules\user\models\Profile';

    public function run()
    {

        $wallItems = Wall::find()
            ->where(['user_id' => $this->user_id, 'class' => $this->relatedClass])
            ->limit(Yii::$app->params['wall_items_limit'])
            ->orderBy('id DESC')
            ->with('author')
            ->with('comments')
            ->asArray()->all();

        return $this->render('wall', [
            'wallItems' => $wallItems,
            'group' => $this->group,
        ]);

    }
}