<?php
/* @var $this yii\web\View */
/* @var $dialog_id integer */
/* @var $user array */
/* @var $fakeUsers array */


use chat\modules\chat\widgets\DialogWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Диалог';
?>
<div class="row">
    <div class="col-12 col-xl-12 dialog">
        <h1 class="h1">Диалог</h1>
        <?php
            echo DialogWidget::widget(['dialog_id' => $dialog_id , 'user' => $user , 'fakeUsers' => $fakeUsers]);
        ?>
    </div>
</div>