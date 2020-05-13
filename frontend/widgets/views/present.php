<?php /* @var $data array */ ?>
<?php /* @var $user_id integer */ ?>

<div class="present-wrap">

    <?php foreach ($data as $item) : ?>

        <div class=" present-item present-btn" onclick="get_present_form(this)" data-user-id="<?php echo $user_id; ?>" data-present-id="<?php echo $item['id'] ?>">
            <img src="<?php echo $item['img'] ?>" alt="">
            <span class="present-name">
                <?php echo $item['price'] ?> рублей
            </span>
        </div>

    <?php endforeach; ?>

</div>
