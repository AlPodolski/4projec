<?php

/* @var $this \yii\web\View */

/* @var $group array */

use frontend\widgets\UserSideBarWidget;

$this->registerJsFile('/files/js/prev.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Мои группы';

use frontend\widgets\PhotoWidget;
use frontend\modules\group\components\helpers\SubscribeHelper;

?>

<div class="row">
    <div class="col-xl-3">
        <?php if (!Yii::$app->user->isGuest) : ?>
            <?php echo UserSideBarWidget::Widget() ?>
        <?php endif; ?>
    </div>
    <div class="col-12 col-xl-9 dialog">

        <div class="page-block friends-list">
            <div class="row">
                <div class="col-8">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                               href="#nav-all-friends" role="tab" aria-controls="nav-home"
                               aria-selected="true">Группы</a>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade active show content" id="nav-all-friends" role="tabpanel"
                     aria-labelledby="nav-home-tab">

                    <?php foreach ($group as $groupItem) : ?>

                        <?php
                            echo $this->renderFile('@app/modules/group/views/group/group-item.php', [
                                'groupItem' => $groupItem
                            ]);
                        ?>

                    <?php endforeach; ?>

                </div>

                <div class="pager" data-url="/group/list" data-page="1">
                </div>

            </div>

        </div>

    </div>
    </div>
