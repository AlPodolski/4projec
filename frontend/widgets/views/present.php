<?php /* @var $data array */ ?>
<?php /* @var $user_id integer */ ?>

<div class="row">

    <?php foreach ($data as $item) : ?>

        <div class="col-4 present-item present-btn" data-toggle="modal" data-user-id="<?php echo $user_id; ?>" data-present-id="<?php echo $item['id'] ?>" data-target="#checkPresentModal" aria-hidden="true">
            <img src="<?php echo $item['img'] ?>" alt="">
            <span class="present-name">
                <?php echo $item['price'] ?> рублей
            </span>
        </div>

    <?php endforeach; ?>

</div>
