<?php

use common\models\City;
use common\models\Params;
use common\models\Price;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\assets\SlickAsset;
/* @var $model Profile */

$this->registerJsFile('/files/js/lightgallery-all.min.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.carousel.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.navigation.js', ['depends' => [\frontend\assets\AppAsset::className()]]);


$this->registerCssFile('/css/lightgallery.min.css');
$this->registerCssFile('/css/owl.carousel.min.css');
$this->registerCssFile('/css/owl.theme.default.min.css');

SlickAsset::register($this);

$this->registerJsFile('/files/js/single.js', ['depends' => [SlickAsset::className()]]);

$photo = Photo::getUserphoto($model->id);
$params = Params::find()->asArray()->all();
$price = Price::find()->asArray()->all();

$metro = $model->getMetro();
$rayon = $model->getRayon();


if ($model){
    $service = $model->getService();
    $postPrice = $model->getUserPrice();
}


?>

<div class="anket">
    <div class="row">
        <div class="col-6">
            <div class="single-photo">

                <div class="slider slider-for">

                    <?php if (!empty($photo)) : ?>

                        <?php foreach ($photo as $item) : ?>

                            <div class="item">
                                <img src="<?php echo $item->file?>" alt="<?php echo $model['username']  ?>">
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

                <div class="slider slider-nav">

                    <?php if (!empty($photo)) : ?>

                        <?php foreach ($photo as $item) : ?>

                        <div class="item">
                            <img src="<?php echo $item->file?>" alt="<?php echo $model['username']  ?>">
                        </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>



            </div>
        </div>
        <div class="col-6">
            <br>
            <div class="user-city">
                <?php

                    $city = City::getCity($model->city);

                ?>

                <p class="city-name"><?php echo $city['city'] ?></p>

            </div>

            <div class="user-name">
                <p class="user-name">
                    <?php echo $model->username ?>
                </p>
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Описание</a>

                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Парметры</a>

                    <?php if ($postPrice) :  ?>

                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Цена</a>

                    <?php endif;  ?>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php if ($model->text) : ?>
                        <p><?php  echo $model->text ?></p>
                    <?php endif; ?>


                    <div class="service-block">

                        <?php if ($service) : ?>

                            <p class="sex-pred">Сексуальные предпочтения</p>

                            <ul>

                                <?php foreach ($service as $item) : ?>

                                    <li>

                                        <?php echo $item->value ?>

                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        <?php endif; ?>
                    </div>

                </div>
                <div class="tab-pane fade param-tab" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <?php if (!empty($metro)) :  ?>

                        <p class="param"> Метро : <?php foreach ($metro as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($rayon)) :  ?>

                        <p class="param"> Район : <?php foreach ($rayon as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['place'])) :  ?>

                        <p class="param"> Место встречи : <?php foreach ($model['place'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['sexual'])) :  ?>

                        <p class="param"> Моя ориентация : <?php foreach ($model['sexual'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['bodyType'])) :  ?>

                        <p class="param"> Телосложение : <?php foreach ($model['bodyType'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['national'])) :  ?>

                        <p class="param"> Национальность : <?php foreach ($model['national'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['financialSituation'])) :  ?>

                        <p class="param"> Материальное положение : <?php foreach ($model['financialSituation'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['interesting'])) :  ?>

                        <p class="param"> Интересы : <?php foreach ($model['interesting'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['professionals'])) :  ?>

                        <p class="param"> Профессия : <?php foreach ($model['professionals'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['vneshnost'])) :  ?>

                        <p class="param"> Моя внешность : <?php foreach ($model['vneshnost'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['vajnoeVPartnere'])) :  ?>

                        <p class="param"> Важное в партнере : <?php foreach ($model['vajnoeVPartnere'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['children'])) :  ?>

                        <p class="param"> Дети : <?php foreach ($model['children'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['family'])) :  ?>

                        <p class="param"> Семья : <?php foreach ($model['family'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['wantFind'])) :  ?>

                        <p class="param"> Хочу найти : <?php foreach ($model['wantFind'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['celiZnakomstvamstva'])) :  ?>

                        <p class="param"> Цели знакомства : <?php foreach ($model['celiZnakomstvamstva'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['lifeGoals'])) :  ?>

                        <p class="param"> Жизненые приоритеты : <?php foreach ($model['lifeGoals'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['alcogol'])) :  ?>

                        <p class="param"> Отношение к алкоголю : <?php foreach ($model['alcogol'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['education'])) :  ?>

                        <p class="param"> Образование : <?php foreach ($model['education'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['breast'])) :  ?>

                        <p class="param"> Размер груди : <?php foreach ($model['breast'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['intimHair'])) :  ?>

                        <p class="param"> Интимная стрижка : <?php foreach ($model['breast'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['hairColor'])) :  ?>

                        <p class="param"> Цвет волос : <?php foreach ($model['breast'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['sferaDeyatelnosti'])) :  ?>

                        <p class="param"> Сфера деятельности : <?php foreach ($model['breast'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                    <?php if (!empty($model['zhile'])) :  ?>

                        <p class="param"> Жилье : <?php foreach ($model['breast'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>


                    <?php if (!empty($model['transport'])) :  ?>

                        <p class="param"> Транспорт : <?php foreach ($model['transport'] as $item) echo $item['value']. ' ' ?>  </p>

                    <?php endif;  ?>

                </div>
                <div class="tab-pane param-tab fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    <?php if ($postPrice) : ?>

                        <?php echo $postPrice['value'] ?> рублей

                    <?php endif; ?>

                </div>
            </div>


        </div>
    </div>
</div>
