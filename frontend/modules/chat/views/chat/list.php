<?php
/* @var $this yii\web\View */

use frontend\widgets\UserSideBarWidget;
use frontend\modules\chat\widgets\MessageListWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">

    <?php echo UserSideBarWidget::Widget()?>

    <div class="col-9">

        <?php
            echo MessageListWidget::widget();
         ?>

    </div>

</div>