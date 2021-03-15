<?php /* @var $post Profile */
/* @var $cityInfo array */
/* @var $cssClass string */
/* @var $city string */

use frontend\modules\user\models\Profile;

?>

<?php

if (!isset($cssClass))  $cssClass = 'col-6 col-sm-6 col-md-4 col-lg-4';

?>

<div class="<?php echo $cssClass ?> article-item">

    <div class="article-anket-wrap position-relative">

        <div class="img-wrap d-flex <?php if (!isset($post->userAvatarRelations['file']) or !file_exists(Yii::getAlias('@webroot') . $post->userAvatarRelations['file'])) echo 'no-img'?> ">

            <a href="https://<?php echo $city ?>.sex-true.com/post/<?php echo $post['id'] ?>" target="_blank">

                <?php if (isset($post['avatar']['file'])) : ?>

                    <picture>
                        <source srcset="https://moskva.sex-true.com/<?= $post['avatar']['file'] ?>">
                        <img loading="lazy" class="img" srcset="https://moskva.sex-true.com/<?= $post['avatar']['file'] ?>">
                    </picture>

                <?php else : ?>

                    <svg width="104" height="112" viewBox="0 0 104 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M85.235 0.367485C94.524 0.453985 103.033 8.54998 103.123 18.255C103.2 43.4185 103.2 68.5815 103.123 93.745C103.037 103.021 95.091 111.54 85.235 111.632C63.0785 111.701 40.9215 111.701 18.765 111.632C9.48098 111.545 0.967481 103.45 0.876981 93.745C0.798981 68.5815 0.798981 43.4185 0.876981 18.255C0.963481 8.97798 8.90798 0.458985 18.765 0.367485C40.9215 0.298485 63.0785 0.298485 85.235 0.367485ZM18.8815 6.36698C12.67 6.38648 6.93798 11.721 6.87698 18.2925C6.79898 43.4555 6.64348 68.62 6.87748 93.782C6.97248 99.9105 12.2405 105.532 18.7275 105.632C40.908 105.84 63.092 105.84 85.2725 105.632C91.4035 105.537 97.0215 100.248 97.1225 93.782C97.356 68.595 97.356 43.405 97.1225 18.218C97.027 12.0905 91.739 6.46848 85.2725 6.36798C63.143 6.16198 41.0115 6.36698 18.8815 6.36698Z" fill="#1D61E1"/>
                        <path d="M51.8145 65.4265C41.443 65.4945 31.108 68.4615 21.687 73.794C19.8045 74.8595 18.3265 76.8645 18.2815 79.335C18.2485 82.3415 18.2425 85.342 18.258 88.344C18.305 91.353 20.435 94.0615 23.0105 94.121C42.336 94.27 61.663 94.27 80.989 94.121C83.4725 94.0635 85.6925 91.4745 85.7415 88.344C85.757 85.3355 85.774 82.326 85.741 79.3175C85.667 75.2805 81.7275 73.27 77.9255 71.4585C69.7785 67.5755 61.0565 65.483 52.306 65.4265C52.142 65.426 51.978 65.426 51.8145 65.4265Z" fill="#1D61E1" fill-opacity="0.709804"/>
                        <path d="M52.3075 62.758C62.763 62.8135 73.198 65.2405 82.677 69.6305C86.561 71.429 89.4685 75.042 89.527 79.423C89.5425 82.936 90.015 86.609 88.975 89.6825C87.596 93.757 83.566 96.731 79.162 96.8145C61.096 96.929 43.0295 96.8155 24.9635 96.8155C19.5115 96.781 14.581 92.113 14.4735 86.4505C14.4435 81.709 13.9735 76.653 16.6595 73.1515C18.546 70.6925 21.5955 69.47 24.5685 68.254C33.339 64.667 42.739 62.7415 52.3075 62.758ZM51.827 68.758C42.136 68.8105 32.48 71.091 23.677 75.19C21.918 76.009 20.5375 77.55 20.495 79.4495C20.4645 81.7605 20.4585 84.067 20.4735 86.3745C20.517 88.687 22.5075 90.7695 24.914 90.815C42.971 90.9295 61.029 90.9295 79.086 90.815C81.4065 90.771 83.481 88.7805 83.5265 86.3745C83.5415 84.0615 83.557 81.7485 83.5265 79.436C83.4575 76.3325 79.776 74.7875 76.224 73.3945C68.612 70.4105 60.4625 68.8015 52.286 68.758C52.133 68.758 51.98 68.758 51.827 68.758Z" fill="#1D61E1"/>
                        <path d="M52.1174 19.637C60.4349 19.716 68.3154 26.1395 69.9039 34.42C71.8869 44.7575 63.4744 56.0245 52.1174 56.097C43.4429 56.152 35.2379 49.2265 33.9629 40.5255C32.5179 30.664 40.4419 20.333 50.8324 19.6735C51.2599 19.6465 51.6884 19.6355 52.1174 19.637ZM51.9204 25.637C46.4014 25.6895 41.1874 29.87 40.0339 35.327C38.8709 40.828 42.0409 46.935 47.2434 49.137C52.9499 51.552 60.3004 48.8155 63.0249 43.1645C66.4944 35.968 61.1314 25.8365 52.2379 25.639C52.1319 25.6375 52.0264 25.6365 51.9204 25.637Z" fill="#1D61E1"/>
                    </svg>

                <?php endif; ?>
            </a>
        </div>
        <div class="name">
            <?php echo $post['name'] ?>
        </div>

        <div class="city-info">
           Реклама
        </div>

    </div>
</div>