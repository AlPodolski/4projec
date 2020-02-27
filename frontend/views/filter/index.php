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

?>

<div class="site-index">

    <div class="body-content">

        <div class="row">

            <?php echo PopularWidget::widget(['city' => $city]); ?>

        </div>

        <div class="row">
            <?php

            echo SidebarWidget::Widget()

            ?>

            <div class="col-9">

                <div class="content">

                    <h1><?php echo $h1; ?></h1>

                    <div class="row">

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

    </div>

</div>