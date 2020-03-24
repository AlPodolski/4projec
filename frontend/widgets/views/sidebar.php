<?php

use frontend\widgets\AdvertWidget;
use frontend\components\UrlBuilder;

$this->registerJsFile('/files/js/sidebar.js', ['depends' => [\frontend\assets\AppAsset::class]]);


?>
<div class="mobile-filter-icon">
    <i class="fas fa-filter"></i>
</div>

    <div class="col-3 filter-sidebar">
        <div class="sidebar-wrap">
        <div class="user-menu menu-nav">
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

                <?php if ($polList) : ?>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse15" aria-expanded="true" aria-controls="collapseOne">
                                    Пол
                                </button>
                            </h5>
                        </div>

                        <div id="collapse15" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($polList as $item) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/pol-'.$item['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $item['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($breastSizeList) : ?>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse16" aria-expanded="true" aria-controls="collapseOne">
                                    Размер груди
                                </button>
                            </h5>
                        </div>

                        <div id="collapse16" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($breastSizeList as $item) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/grud-'.$item['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $item['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($hairColorList) : ?>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse17" aria-expanded="true" aria-controls="collapseOne">
                                    Цвет волос
                                </button>
                            </h5>
                        </div>

                        <div id="collapse17" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($hairColorList as $item) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/cvet-volos-'.$item['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $item['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($intimHairList) : ?>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse18" aria-expanded="true" aria-controls="collapseOne">
                                    Интимная стрижка
                                </button>
                            </h5>
                        </div>

                        <div id="collapse18" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($intimHairList as $item) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/intimnaya-strizhka-'.$item['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $item['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
                <?php if ($materialnoePolojenie) : ?>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse19" aria-expanded="true" aria-controls="collapseOne">
                                    Материальное положение
                                </button>
                            </h5>
                        </div>

                        <div id="collapse19" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($materialnoePolojenie as $item) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/materialnoe-polozhenie-'.$item['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $item['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/metro-'.$metro['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $metro['value'] ?></a>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/rayon-'.$rayon['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $rayon['value'] ?></a>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/interesy-'.$interesiitem['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $interesiitem['value'] ?></a>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/deti-'.$detiItem['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $detiItem['value'] ?></a>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/semejnoe-polozhenie-'.$semeinoePolojenieItem['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $semeinoePolojenieItem['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($celiZnakomstva) : ?>

                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse14" aria-expanded="true" aria-controls="collapseOne">
                                    Цели знакомства
                                </button>
                            </h5>
                        </div>

                        <div id="collapse14" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($celiZnakomstva as $celiZnakomstvaItem) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/celi-znakomstva-'.$celiZnakomstvaItem['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $celiZnakomstvaItem['value'] ?></a>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/otnoshenie-k-kureniyu-'.$smokeItem['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $smokeItem['value'] ?></a>

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
                                    Отношение к алкоголю
                                </button>
                            </h5>
                        </div>

                        <div id="collapse13" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($alcogol as $alcogolItem) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/otnoshenie-k-akogolyu-'.$alcogolItem['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $alcogolItem['value'] ?></a>

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
                                    Сексуальные предпочтения
                                </button>
                            </h5>
                        </div>

                        <div id="collapse8" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?php foreach ($serviceList as $service) : ?>

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/usluga-'.$service['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $service['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($placeList) : ?>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/mesto-vstreji-'.$place['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $place['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($ageList) : ?>


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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/vozrast-'.$age['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $age['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($priceList) : ?>

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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/cena-'.$price['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $price['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($nationalList) : ?>


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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/nacionalnost-'.$national['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $national['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($bodyList) : ?>


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

                                    <?php $url = UrlBuilder::buildUrlForFilter($param, '/teloslozhenie-'.$body['url']) ?>

                                    <a href="/<?php echo $url; ?>"><?php echo $body['value'] ?></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

        <?php

        echo AdvertWidget::widget();

        ?>

    </div>
</div>
