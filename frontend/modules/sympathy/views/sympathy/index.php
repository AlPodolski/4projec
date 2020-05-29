<?php
/* @var $this yii\web\View */
/* @var $photo Photo */

/* @var $userFriends array */
/* @var $post array */

use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;
use frontend\widgets\SidebarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->title = 'Симпатии';

?>
<div class="row">


    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget() ?>

        <?php endif; ?>

        <?php
        echo SidebarWidget::Widget()
        ?>
    </div>


    <div class="col-12 col-xl-9">

        <h1 class="text-center">
            Возможно, Вам кто нибудь понравится... Кликай на сердечко и найди еще больше симпатий
        </h1>

        <div class="post-wrapper">
            <div class="page-block main-info-anket">
                <?php

                if ($post) echo $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/item.php'),[
                    'post' => $post
                ]);
                else echo $this->renderFile(Yii::getAlias('@app/modules/sympathy/views/sympathy/no-content.php'));

                ?>
            </div>
        </div>

    </div>

</div>
