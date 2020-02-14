<?php
/* @var $newsList News[] */
/* @var $this View */


use common\models\News;
use frontend\widgets\SidebarWidget;
use yii\web\View;

$this->title = 'Интим объявления';

$this->registerJsFile('/files/js/news.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="row">
    <?php

    echo SidebarWidget::Widget()

    ?>

    <div class="col-9">

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
