<?php

use common\models\Age;
use common\models\BodyType;
use common\models\National;
use common\models\Place;
use common\models\Price;
use common\models\Service;
use frontend\widgets\AdvertWidget;
use common\models\Metro;
use common\models\Rayon;
use \common\models\Interesting;
use \common\models\Children;
use common\models\Family;
use common\models\CeliZnakomstvamstva;
use common\models\Smoking;
use common\models\Alcogol;


$this->registerJsFile('/files/js/sidebar.js', ['depends' => [\frontend\assets\AppAsset::class]]);

$placeList = Place::find()->asArray()->all();
$ageList = Age::find()->asArray()->all();
$priceList = Price::find()->asArray()->all();
$nationalList = National::find()->asArray()->all();
$bodyList = BodyType::find()->asArray()->all();
$serviceList = Service::find()->asArray()->all();
$metroList = Metro::find()->where(['city' => Yii::$app->controller->actionParams['city']])->asArray()->all();
$rayonList = Rayon::find()->where(['city' => Yii::$app->controller->actionParams['city']])->asArray()->all();
$interesi = Interesting::find()->asArray()->all();
$deti = Children::find()->asArray()->all();
$semeinoePolojenie = Family::find()->asArray()->all();
$celiZnakomstva = CeliZnakomstvamstva::find()->asArray()->all();
$smoke = Smoking::find()->asArray()->all();
$alcogol = Alcogol::find()->asArray()->all();

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

            <?php if ($metroList) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapseOne">
                            Метро
                        </button>
                    </h5>
                </div>

                <div id="collapse6" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($metroList as $metro) : ?>
                            <a href="/metro-<?php echo $metro['url'] ?>"><?php echo $metro['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($rayonList) : ?>

                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapseOne">
                                Район
                            </button>
                        </h5>
                    </div>

                    <div id="collapse7" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <?php foreach ($rayonList as $rayon) : ?>
                                <a href="/rayon-<?php echo $rayon['url'] ?>"><?php echo $rayon['value'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <?php if ($interesi) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapseOne">
                            Интересы
                        </button>
                    </h5>
                </div>

                <div id="collapse9" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($interesi as $interesiitem) : ?>
                            <a href="/interesy-<?php echo $interesiitem['url'] ?>"><?php echo $interesiitem['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($deti) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapseOne">
                            Дети
                        </button>
                    </h5>
                </div>

                <div id="collapse10" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($deti as $detiItem) : ?>
                            <a href="/deti-<?php echo $detiItem['url'] ?>"><?php echo $detiItem['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($semeinoePolojenie) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapseOne">
                            Семейное положение
                        </button>
                    </h5>
                </div>

                <div id="collapse11" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($semeinoePolojenie as $semeinoePolojenieItem) : ?>
                            <a href="/semejnoe-polozhenie-<?php echo $semeinoePolojenieItem['url'] ?>"><?php echo $semeinoePolojenieItem['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($celiZnakomstva) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapseOne">
                            Цели знакомства
                        </button>
                    </h5>
                </div>

                <div id="collapse11" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($celiZnakomstva as $celiZnakomstvaItem) : ?>
                            <a href="/semejnoe-polozhenie-<?php echo $celiZnakomstvaItem['url'] ?>"><?php echo $celiZnakomstvaItem['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($smoke) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapseOne">
                            отношение к курению
                        </button>
                    </h5>
                </div>

                <div id="collapse12" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($smoke as $smokeItem) : ?>
                            <a href="/otnoshenie-k-kureniyu-<?php echo $smokeItem['url'] ?>"><?php echo $smokeItem['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($alcogol) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse13" aria-expanded="true" aria-controls="collapseOne">
                            Отношение к лкоголю
                        </button>
                    </h5>
                </div>

                <div id="collapse13" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($alcogol as $alcogolItem) : ?>
                            <a href="/otnoshenie-k-akogolyu-<?php echo $alcogolItem['url'] ?>"><?php echo $alcogolItem['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($serviceList) : ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapseOne">
                            Услуги
                        </button>
                    </h5>
                </div>

                <div id="collapse8" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($serviceList as $service) : ?>
                            <a href="/usluga-<?php echo $service['url'] ?>"><?php echo $service['value'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Место
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?php foreach ($placeList as $place) : ?>
                            <a href="/mesto-vstreji-<?php echo $place['url'] ?>"><?php echo $place['value'] ?></a>
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
                            <a href="/vozrast-<?php echo $age['url'] ?>"><?php echo $age['value'] ?></a>
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
                            <a href="/cena-<?php echo $price['url'] ?>"><?php echo $price['value'] ?></a>
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
                            <a href="/nacionalnost-<?php echo $national['url'] ?>"><?php echo $national['value'] ?></a>
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
                            <a href="/teloslozhenie-<?php echo $body['url'] ?>"><?php echo $body['value'] ?></a>
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
