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
$service = $model->getService();
$params = Params::find()->asArray()->all();
$postParams = $model->getUserParams();
$price = Price::find()->asArray()->all();
$postPrice = $model->getUserPrice();

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
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Цены</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php if ($model->text) : ?>
                        <p><?php  echo $model->text ?></p>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade param-tab" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <?php if ($params) : ?>

                        <?php foreach ($params as $param) : ?>

                            <p class="param">

                                <?php echo $param['param']  ?> :

                                <?php foreach ($postParams as $postParam) : ?>

                                    <?php if ($postParam['param_id'] == $param['id']) echo $postParam['value'] ?>

                                <?php endforeach; ?>

                            </p>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    <?php if ($price) : ?>

                        <?php foreach ($price as $param) : ?>

                            <p class="param">

                                <?php echo $param['name']  ?> :

                                <?php foreach ($postPrice as $item) : ?>

                                    <?php if ($item['price_id'] == $param['id']) echo $item['value'] ?>

                                <?php endforeach; ?>

                            </p>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
            </div>



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
    </div>
</div>
