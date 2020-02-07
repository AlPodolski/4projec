<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
 $this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);

?>
<div class="row">

    <?php echo UserSideBarWidget::Widget()?>

    <div class="col-8">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
                [
                        'model' => $model,
                ]
            ) ?>

    </div>

</div>

<div class="wrap-avatar">


</div>





