<?php


namespace frontend\controllers;

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

                if ($model->load(Yii::$app->request->post()) and $id = $model->save()){

                    $comment = Comments::find()->where(['id' => $id])->with('author')->asArray()->one();

                    return  $this->renderFile('@app/views/comment/comment-item.php', [
                        'comment' => $comment
                    ]);

                }

            }

        }

        return $this->goHome();
    }
}