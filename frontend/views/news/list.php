<?php
/* @var $newsList News[] */
/* @var $this View */


use common\models\News;
use frontend\widgets\SidebarWidget;
use yii\web\View;
use frontend\widgets\UserSideBarWidget;

$this->title = 'Новости';
?>
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

        <div class="anket">

            <h1>Новости</h1>

            <?php foreach ($newsList as $news) : ?>

                <?php echo  $this->renderFile('@app/views/news/item.php' , [
                    'news' => $news
                ]) ?>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="col-12 advert-pager" data-page="1"></div>

</div>
