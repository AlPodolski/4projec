<?php
/* @var $this yii\web\View */
/* @var $user_id integer */

use frontend\widgets\UserSideBarWidget;
use frontend\modules\chat\widgets\MessageListWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

$this->title = 'Диалоги';

?>
<div class="row">

    <div class="col-xl-3">
        <?php echo UserSideBarWidget::Widget()?>
    </div>
    <div class="col-12 col-xl-9">

        <?php
            echo MessageListWidget::widget(['user_id' => $user_id]);
         ?>

    </div>

</div>