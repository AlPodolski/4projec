<?php

/* @var $date string */
/* @var $messageCount \common\models\CountMessage[] */

$i = 1;

?>
<?php if ($messageCount) : ?>
<div class="row ">
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
                    <?php echo ucfirst($item->user_name) ?> :
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
</div>
<?php endif; ?>