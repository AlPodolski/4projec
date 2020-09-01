<?php

namespace frontend\modules\wall\widgets;

use frontend\modules\user\models\News;
use frontend\modules\wall\models\Wall;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

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

            $newsids = News::find()
                ->where(['user_id' => $this->user_id])
                ->select('news_id')
                ->orderBy('timestamp DESC')
                ->limit(Yii::$app->params['wall_items_limit'])
                ->offset($this->offset)
                ->asArray()
                ->all();

            $wallItems = Wall::find()
                ->where(['in', 'id', ArrayHelper::getColumn($newsids, 'news_id')])
                ->orderBy('id DESC')
                ->with('author')
                ->with('files')
                ->with('comments')
                ->asArray()->all();

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

        if ($wallItems) return $this->render('wall', [
            'news' => $this->news,
            'wallItems' => $wallItems,
            'group' => $this->group,
            'wrapCssClass' => $this->wrapCssClass,
        ]);

        else{
            if (!$this->offset){

                return '<p class="alert alert-info">Пока ничего нет</p>';

            }
        }

        return '';

    }
}