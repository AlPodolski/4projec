<?php

/* @var $this yii\web\View */
/* @var $userCountWhoRegister24HourAgo integer */
/* @var $profilesCount integer */
/* @var $realProfileCount integer */
/* @var $promoRegisterCount integer */
/* @var $promoRegisterWeek array */
/* @var $userCashPay array */
/* @var $messageCount array */
/* @var $date string */

$this->title = 'My Yii Application';

$i = 1;

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
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Регистраций с промо параметром</p>

                        <h3>Всего <?php echo $promoRegisterCount ?></h3>


                        <?php foreach ($promoRegisterWeek as $item) : ?>

                            <p>Регистраций <?php echo $item['date'] ?> - <?php echo $item['count'] ?> </p>

                        <?php endforeach; ?>

                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Пополнения</p>

                        <?php foreach ($userCashPay as $item) : ?>

                            <p>Приход <?php echo $item['date'] ?> - <?php echo $item['count'] ?> </p>

                        <?php endforeach; ?>

                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <?php if ($messageCount) : ?>
                    <div class="col-lg-4 margin-top-30">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <p>Отправлено сообщений за <?php echo $date ?></p>

                                <?php foreach ($messageCount as $item) : ?>

                                    <?php

                                    if ($i == 1) $class = 'text-uppercase fw-bold big-text';
                                    else $class = '';

                                    ?>

                                    <p class="<?php echo $class ?>">
                                        <?php echo $i ?>.
                                        <?php echo $item->user_name ?> :
                                        <?php echo $item->count ?>
                                    </p>

                                    <?php $i++; ?>

                                <?php endforeach; ?>

                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

            <?php endif; ?>

        </div>

    </div>
</div>
