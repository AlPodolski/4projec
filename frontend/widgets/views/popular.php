<?php /* @var $popularUsers Profile[] */

use frontend\modules\user\models\Profile; ?>
<div class="col-12">
    <div class="row popular-wrap">
        <div class="col-3 popular-block-wrap">
            <div class="popular-block">
                <div class="row">
                    <div class="col-12"><span class="best-nad">Лучшие</span></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="popular-anket">
                            Популярные анкеты
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="check-nad">
                            Проверенные девушки с рекомендацией портала
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="#">посмотреть</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-9">
            <div class="row">
                <?php foreach ($popularUsers as $popularUsers) : ?>

                    <?php $popularUsers->getAvatar() ?>

                    <div class="col-3">
                        <div class="popular-anket-wrap">
                            <img src="<?php echo $popularUsers->avatar ?>" alt="">
                            <div class="razd">

                            </div>
                            <div class="name">
                                <?php echo $popularUsers->username; ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    </div>

</div>
