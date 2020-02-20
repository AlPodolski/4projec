<?php
/* @var $this yii\web\View */
/* @var $posts Profile[] */

/* @var $city string */

use frontend\modules\user\models\Profile;
use frontend\widgets\PopularWidget;
use frontend\widgets\SidebarWidget;


$this->title = 'Знакомства фильтр';
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

                    <div class="row">

                        <?php foreach ($posts as $post) : ?>

                            <?php echo $this->renderFile('@app/views/layouts/article.php', [
                                'post' => $post
                            ]) ?>

                        <?php endforeach; ?>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>