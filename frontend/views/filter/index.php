<?php
/* @var $this yii\web\View */
/* @var $posts Profile[] */
/* @var $title string */
/* @var $h1 string */
/* @var $des string */

/* @var $city string */

use frontend\modules\user\models\Profile;
use frontend\widgets\PopularWidget;
use frontend\widgets\SidebarWidget;


$this->title = $title;

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $des
]);
$this->registerJsFile('/files/js/page_a.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
?>

<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php

            echo SidebarWidget::Widget()

            ?>

            <div class="col-9">

                <div class="content-wrap">

                    <?php if (!empty(Yii::$app->view->params['marks'])) : ?>

                        <?php echo Yii::$app->view->params['marks'] ?>

                    <?php endif; ?>

                    <h1><?php echo $h1; ?></h1>

                    <div class="row content">

                        <?php if ($posts) : ?>

                        <?php foreach ($posts as $post) : ?>

                            <?php echo $this->renderFile('@app/views/layouts/article.php', [
                                'post' => $post
                            ]) ?>

                        <?php endforeach; ?>

                        <?php else : ?>

                            <p>Ничего нет</p>

                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>

        <div class="col-12 pager" data-page="1" data-url="<?php echo Yii::$app->request->url ?>" data-reqest="<?php echo Yii::$app->request->url ?>"></div>

    </div>

</div>