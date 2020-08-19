<?php

namespace frontend\modules\wall\widgets;

use frontend\modules\user\models\News;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\base\Widget;

class WallWidget extends Widget
{

    public $user_id;
    public $group = null;
    public $relatedClass = 'frontend\modules\user\models\Profile';
    public $wrapCssClass = '';
    public $offset = 0;
    public $news = false;

    public function run()
    {

        if ($this->news){

            $wallItems = News::find()
                ->where(['user_id' => $this->user_id])
                ->asArray()
                ->all();

        }else{
            $wallItems = Wall::find()
                ->where(['user_id' => $this->user_id, 'class' => $this->relatedClass])
                ->limit(Yii::$app->params['wall_items_limit'])
                ->offset($this->offset)
                ->orderBy('id DESC')
                ->with('author')
                ->with('files')
                ->with('comments')
                ->asArray()->all();
        }

        return $this->render('wall', [
            'wallItems' => $wallItems,
            'group' => $this->group,
            'wrapCssClass' => $this->wrapCssClass,
        ]);

    }
}