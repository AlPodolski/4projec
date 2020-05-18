<?php
/* @var $advertList Advert[] */
/* @var $this View */

use frontend\modules\advert\models\Advert;
use frontend\widgets\SidebarWidget;
use yii\web\View;
use frontend\widgets\UserSideBarWidget;

$this->title = 'Интим объявления';

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Объявления интим знакомств с девушками, парнями и парами для общения, отношений и секса. Без регистрации! Бесплатно!'
]);
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

        <div class="anket content">

            <h1>Интим объявления</h1>

            <?php foreach ($advertList as $advert) : ?>

                <?php echo  $this->renderFile('@app/modules/advert/views/advert/item.php' , [
                        'advert' => $advert
                ]) ?>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="col-12 pager" data-url="/more-adverds" data-page="1"></div>

</div>


