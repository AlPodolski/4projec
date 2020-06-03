<?php
/* @var $this yii\web\View */
/* @var $dialog_id integer */
/* @var $user array */

use frontend\widgets\UserSideBarWidget;
use frontend\modules\chat\widgets\DialogWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">
    <div class="col-xl-3">
        <?php echo UserSideBarWidget::Widget() ?>
    </div>
    <div class="col-12 col-xl-3 ">
        <?php
            echo DialogWidget::widget(['dialog_id' => $dialog_id, 'user' => $user]);
        ?>
    </div>
</div>