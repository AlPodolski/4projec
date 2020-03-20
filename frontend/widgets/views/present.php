<?php /* @var $data array */ ?>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">

        <?php $i = 0; ?>

        <?php foreach ($data as $key => $value) : ?>

        <?php

            if ($i == 0) $active = 'active';
            else $active = '';

        ?>

            <a class="nav-item nav-link <?php echo $active ?> " id="nav-home-tab" data-toggle="tab" href="#nav-present-<?php echo $key?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo $value[0]['category_name'] ?></a>

        <?php $i++ ?>

        <?php endforeach; ?>

    </div>
</nav>
<br>
<div class="tab-content" id="nav-tabContent">

        <?php $i = 0; ?>

        <?php foreach ($data as $key => $value) : ?>

        <?php

            if ($i == 0) $active = 'active';
            else $active = '';

        ?>

        <div class="tab-pane fade show <?php echo $active ?> " id="nav-present-<?php echo $key?>" role="tabpanel" aria-labelledby="nav-home-tab">

            <div class="service-block">

                        <div class="row">

                            <?php foreach ($value[0]['presents'] as $item) : ?>

                                <div class="col-4 present-item">
                                    <img src="<?php echo $item['img'] ?>" alt="">
                                    <span class="present-name">
                                        <?php echo $item['name'] ?> -  <?php echo $item['price'] ?>
                                        <img src="/files/img/icn-lg-coins.png" alt="">
                                    </span>
                                </div>

                            <?php endforeach; ?>

                        </div>

            </div>

        </div>

            <?php $i++ ?>

    <?php endforeach; ?>


</div>
