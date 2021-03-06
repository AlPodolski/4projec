<?php


namespace frontend\controllers;

use frontend\components\helpers\CommentsHelper;
use frontend\modules\events\components\helpers\AddEvent;
use frontend\modules\events\models\Events;
use yii\web\Controller;
use common\models\Comments;
use frontend\models\forms\AddCommentForm;
use Yii;

class CommentController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->request->isPost){

            if (!Yii::$app->user->isGuest){

                $model = new AddCommentForm();

                $model->author_id = Yii::$app->user->id;
                $model->created_at = \time();

                if ($model->load(Yii::$app->request->post()) and $model->validate() and  $id = $model->save()){

                    $comment = Comments::find()->where(['id' => $id])->with('author')->asArray()->one();

                    if ( $user_id = CommentsHelper::getCommentOwner($comment['related_id'], $comment['class'] ) and $user_id['user_id'] != $model->author_id){

                        AddEvent::Add(
                            $model->author_id,
                            $user_id['user_id'],
                            Events::NEW_COMMENT,
                            $comment['related_id'],
                            $model->class
                        );

                    }

                    return  $this->renderFile('@app/views/comment/comment-item.php', [
                        'comment' => $comment
                    ]);

                }

            }

        }

    }
}