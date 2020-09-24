<?php
/* @var $this yii\web\View */
/* @var $posts Profile[] */
/* @var $title string */
/* @var $h1 string */
/* @var $des string */
/* @var $cityInfo array */

/* @var $city string */
/* @var $param string */

use frontend\modules\user\models\Profile;
use frontend\widgets\SidebarWidget;
use frontend\widgets\UserSideBarWidget;


$this->title = $title;

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $des
]);

?>

<div class="site-index margin-top-30">

    <div class="body-content">

        <div class="row">

            <?php if (!Yii::$app->user->isGuest) : ?>

            <div class="col-3 filter-sidebar">

                    <?php echo UserSideBarWidget::Widget()?>

                <?php
                echo SidebarWidget::Widget()
                ?>

            </div>

            <?php endif; ?>

            <?php if (!Yii::$app->user->isGuest) : ?>

            <?php $class = 'col-6 col-sm-6 col-md-4 col-lg-4' ?>

            <div class="col-12 col-xl-9 main-banner-wrap margin-bottom-30">

                <?php else : ?>

                <?php $class = 'col-6 col-sm-6 col-md-4 col-lg-3' ?>

                <div class="col-12 col-xl-12 main-banner-wrap margin-bottom-30">

                <?php endif; ?>

                <div class="content-wrap">

                    <?php if (!empty(Yii::$app->view->params['marks'])) : ?>

                        <?php echo Yii::$app->view->params['marks'] ?>

                    <?php endif; ?>

                    <h1><?php echo $h1; ?></h1>

                    <div class="row content">

                        <div data-url="/<?php echo $param ?>" class="col-12"></div>

                        <?php if ($posts) : ?>

                        <?php foreach ($posts as $post) : ?>

                            <?php echo $this->renderFile('@app/views/layouts/article.php', [
                                'post' => $post,
                                    'cityInfo' => $cityInfo,
                                    'cssClass' => $class
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

        <svg class="filter" version="1.1">
            <defs>
                <filter id="gooeyness">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -10" result="gooeyness" />
                    <feComposite in="SourceGraphic" in2="gooeyness" operator="atop" />
                </filter>
            </defs>
        </svg>
        <div class="dots">
            <div class="dot mainDot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>

    </div>

</div>