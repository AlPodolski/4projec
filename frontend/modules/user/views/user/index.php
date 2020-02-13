<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">

    <?php echo UserSideBarWidget::Widget()?>

    <div class="col-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
                [
                        'model' => $model,
                ]
            ) ?>

    </div>

</div>





