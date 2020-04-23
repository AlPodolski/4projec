<?php

/* @var $this yii\web\View */
/* @var $userCountWhoRegister24HourAgo integer */
/* @var $profilesCount integer */
/* @var $realProfileCount integer */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                        <p>Регистраций сегодня</p>
                        <h3><?php echo $userCountWhoRegister24HourAgo ?></h3>

                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Всего пользователей</p>
                        <h3><?php echo $profilesCount ?></h3>

                        <p>Настоящих Пользователей <?php echo $realProfileCount ?> </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
