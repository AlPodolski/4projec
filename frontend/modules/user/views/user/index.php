<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">

    <div class="col-3">
        <?php echo UserSideBarWidget::Widget()?>
    </div>

    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
                [
                    'model' => $model,
                    'city' => $city,
                ]
            ) ?>

    </div>

</div>





