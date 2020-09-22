<?php

namespace frontend\modules\wall\widgets;

use frontend\modules\user\models\News;
use frontend\modules\user\models\Photo;
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
                ->orWhere(['class' => Photo::class])
                ->limit(Yii::$app->params['wall_items_limit'])
                ->offset($this->offset)
                ->orderBy('id DESC')
                ->with('author')
                ->with('files')
                ->with('parentWrite')
                ->with('comments')
                ->asArray()->all();

            foreach ($wallItems as &$wallItem){

                if ($wallItem['parentWrite']){

                    $class = $wallItem['parentWrite']['class'];

                    $wallItem['parentWrite']['author'] = Yii::$app->cache->get(Yii::$app->params['parent_write_key'].'_'.$class.'_'.$wallItem['parentWrite']['user_id']);

                    if ($wallItem['parentWrite']['author'] === false) {
                        // $data нет в кэше, вычисляем заново
                        $wallItem['parentWrite']['author'] = $class::find()
                            ->where(['id' => $wallItem['parentWrite']['user_id']])
                            ->with('avatar')
                            ->asArray()
                            ->one();
                        // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
                        Yii::$app->cache->set(Yii::$app->params['parent_write_key'].'_'.$class.'_'.$wallItem['parentWrite']['user_id'] , $wallItem['parentWrite']['author']);
                    }

                }

                if ($wallItem['class'] == Photo::class){

                    $wallItem['photo'] = Photo::find()->where(['id' => $wallItem['related_id']])->asArray()->one();

                }

            }

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