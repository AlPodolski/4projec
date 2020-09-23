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
            <div class="col-3 filter-sidebar">

                <?php if (!Yii::$app->user->isGuest) : ?>

                    <?php echo UserSideBarWidget::Widget()?>

                <?php endif; ?>

                <?php
                echo SidebarWidget::Widget()
                ?>
            </div>

            <div class="col-12 col-xl-9">

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