<?php $this->title = $model->username; ?>
<div class="row">

    <?php use frontend\widgets\SideBarWidget;

    echo SidebarWidget::Widget() ?>

    <?php $this->title = $model->username; ?>

    <div class="col-9">

        <?php echo $this->renderFile('@app/views/anket/anket.php',
            [
                'model' => $model,
            ]
        ) ?>

    </div>

</div>