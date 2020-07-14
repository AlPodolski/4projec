<?php /* @var $data array */ ?>

<div class="present-wrap">

    <?php foreach ($data as $item) : ?>

        <div class=" present-item present-btn" onclick="get_present_form(this)" data-user-id="" data-from-id="" data-present-id="<?php echo $item['id'] ?>">
            <img loading="lazy" src="http://msk.<?php echo Yii::$app->params['site_name'] ?>/<?php echo $item['img'] ?>" alt="">
            <span class="present-name">
                <?php echo $item['price'] ?> рублей
            </span>
        </div>

    <?php endforeach; ?>

</div>
