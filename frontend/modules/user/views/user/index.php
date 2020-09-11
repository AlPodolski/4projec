<?php
/* @var $this yii\web\View */
/* @var $photo Photo */
/* @var $userFriends array */
/* @var $userHeart array */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;
use frontend\widgets\SidebarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $model->username;
?>
<div class="row">


    <div class="col-3 filter-sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?php echo UserSideBarWidget::Widget()?>

        <?php endif; ?>

        <?php
        echo SidebarWidget::Widget()
        ?>
    </div>


    <div class="col-12 col-xl-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
                [
                    'model' => $model,
                    'city' => $city,
                    'userFriends' => $userFriends,
                    '$userHeart' => $userHeart,
                ]
            ) ?>

    </div>

</div>





