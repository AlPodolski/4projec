<?php

use common\models\Age;
use common\models\BodyType;
use common\models\National;
use common\models\Place;
use common\models\Price;
use frontend\widgets\AdvertWidget;

$this->registerJsFile('/files/js/sidebar.js', ['depends' => [\frontend\assets\AppAsset::class]]);

$placeList = Place::find()->asArray()->all();
$ageList = Age::find()->asArray()->all();
$priceList = Price::find()->asArray()->all();
$nationalList = National::find()->asArray()->all();
$bodyList = BodyType::find()->asArray()->all();

?>
<div class="col-3">
    <div class="user-menu">
        <div class="row">
            <div class="col-9">
                <p class="user-name">
                    навигаця по сайту
                </p>
            </div>
            <div class="col-3">
                    <span class="side-bar-nav-burger">
                        <i class="fas fa-bars">

                        </i>
                    </span>
            </div>
        </div>
    </div>

    <div class="sidebar-menu-list">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Место
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($placeList as $place) : ?>
                            <a href="/<?php echo $place['url'] ?>"><?php echo $place['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Возраст
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($ageList as $age) : ?>
                            <a href="/<?php echo $age['url'] ?>"><?php echo $age['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Цены
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($priceList as $price) : ?>
                            <a href="/<?php echo $price['url'] ?>"><?php echo $price['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapseThree">
                            Национальность
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($nationalList as $national) : ?>
                            <a href="/<?php echo $national['url'] ?>"><?php echo $national['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapseThree">
                            Телосложение
                        </button>
                    </h5>
                </div>
                <div id="collapse5" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($bodyList as $body) : ?>
                            <a href="/<?php echo $body['url'] ?>"><?php echo $body['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php

    echo AdvertWidget::widget();

    ?>

</div>
