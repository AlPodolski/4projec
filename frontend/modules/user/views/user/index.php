<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
/* @var $userFriends array */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $model->username;
?>
<div class="row">


        <?php echo \frontend\widgets\SidebarWidget::Widget()?>


    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
                [
                    'model' => $model,
                    'city' => $city,
                    'userFriends' => $userFriends,
                ]
            ) ?>

    </div>

</div>





