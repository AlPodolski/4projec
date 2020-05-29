<?php /* @var $post array */ ?>
<?php

use common\models\City;
use frontend\modules\user\components\helpers\FriendsRequestHelper;
use frontend\modules\user\components\helpers\FriendsHelper;


?>
<div class="row">
    <div class="col-12 col-xl-6 col-lg-4 col-md-6">
        <div class="post-photo">

            <?php if (isset($post['userAvatarRelations']['file']) and file_exists(Yii::getAlias('@webroot') . $post['userAvatarRelations']['file']) and $post['userAvatarRelations']['file']) : ?>

                <picture>
                    <source srcset="<?= Yii::$app->imageCache->thumbSrc($post['userAvatarRelations']['file'], '400_500') ?>" >
                    <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($post['userAvatarRelations']['file'], '400_500') ?>" >
                </picture>

            <?php else : ?>

                <img src="/files/img/nophoto.png" alt="">

            <?php endif; ?>

            <div class="actions-wrap">
                <div class="row">
                    <div class="col-4">
                        <div class="dislike-post" onclick="add_sympathy(this)" data-action="skip" data-id="<?php echo $post['id'] ?>">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.8989 33.5989L25.3 20L38.8989 6.40115C40.367 4.93297 40.367 2.56931 38.8989 1.10113C37.4307 -0.367044 35.067 -0.367044 33.5989 1.10113L20 14.7L6.40115 1.10113C4.93297 -0.367044 2.56931 -0.367044 1.10113 1.10113C-0.367044 2.56931 -0.367044 4.93297 1.10113 6.40115L14.7 20L1.10113 33.5989C-0.367044 35.067 -0.367044 37.4307 1.10113 38.8989C2.56931 40.367 4.93297 40.367 6.40115 38.8989L20 25.3L33.5989 38.8989C35.067 40.367 37.4307 40.367 38.8989 38.8989C40.3566 37.4307 40.3566 35.0566 38.8989 33.5989Z" fill="url(#paint0_linear)"/>
                                <defs>
                                    <linearGradient id="paint0_linear" x1="0" y1="0" x2="40" y2="45.5" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#486BEF"/>
                                        <stop offset="1" stop-color="#80DFFD"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="present-wrap" onclick="get_presents(this)" data-user-id="<?php echo $post['id'] ?>">
                            <div class="present">
                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 23H2V14H48V23H30" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M30 14H20V48H30V14Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M18.7778 22.2222H2.77783V47.2222H44.7778V22.2222H28.7778" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                    <path d="M25 13C25 13 21.418 13 17 13C12.582 13 8 10.419 8 6C8 4.172 8.878 2 12.319 2C19.236 2 19.363 13 25 13Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M25 13C25 13 28.582 13 33 13C37.418 13 42 10.419 42 6C42 4.172 41.122 2 37.681 2C30.764 2 30.637 13 25 13Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="like-wrap" onclick="add_sympathy(this)" data-action="like" data-id="<?php echo $post['id'] ?>">
                            <div class="like">
                                <svg width="57" height="57" viewBox="0 0 57 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M50.6053 9.01312C47.6801 6.08262 43.7152 4.42698 39.5746 4.40696C35.4341 4.38694 31.4534 6.00417 28.5 8.90625C25.5426 5.9749 21.542 4.33841 17.378 4.35678C13.2141 4.37515 9.22804 6.04689 6.29669 9.00422C3.36534 11.9615 1.72885 15.9622 1.74722 20.1261C1.7656 24.2901 3.43733 28.2762 6.39466 31.2075L6.66185 31.4569L6.76872 31.5816L25.2225 50.0353C26.0935 50.9011 27.2718 51.3871 28.5 51.3871C29.7281 51.3871 30.9064 50.9011 31.7775 50.0353L49.2515 32.5612L49.4297 32.4009L50.249 31.5637L50.534 31.2966C52.0052 29.84 53.1744 28.1073 53.9745 26.1979C54.7746 24.2885 55.1899 22.2399 55.1965 20.1696C55.2031 18.0994 54.801 16.0482 54.0131 14.1337C53.2252 12.2192 52.0672 10.4791 50.6053 9.01312V9.01312ZM48.0937 28.6781L47.8265 28.9275L47.5593 29.2125L47.0428 29.7469L46.8825 29.8894L29.2481 47.5059C29.0483 47.7018 28.7797 47.8114 28.5 47.8114C28.2202 47.8114 27.9516 47.7018 27.7518 47.5059L9.47622 29.2303C9.35467 29.0909 9.22374 28.96 9.08434 28.8384C9.01693 28.7947 8.95682 28.7406 8.90622 28.6781C6.76249 26.3779 5.5957 23.3351 5.65187 20.1913C5.70803 17.0474 6.98275 14.0483 9.20728 11.826C11.4318 9.60383 14.4323 8.33223 17.5762 8.27933C20.7201 8.22643 23.7616 9.39638 26.0597 11.5425L26.22 11.7206L26.3981 11.9344L27.2353 12.7716C27.4009 12.9385 27.5979 13.071 27.8149 13.1615C28.032 13.2519 28.2648 13.2985 28.5 13.2985C28.7351 13.2985 28.9679 13.2519 29.185 13.1615C29.4021 13.071 29.5991 12.9385 29.7647 12.7716L30.6018 11.9344C30.6018 11.9344 30.78 11.7562 30.8334 11.6672L30.9581 11.5247C33.2328 9.25236 36.317 7.97672 39.5322 7.97839C42.7474 7.98006 45.8303 9.2589 48.1026 11.5336C50.375 13.8083 51.6506 16.8925 51.6489 20.1077C51.6473 23.3229 50.3684 26.4058 48.0937 28.6781V28.6781Z" fill="white"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-lg-8 col-md-6">
        <div class="anket-info">
            <div class="anket-info-content">
                <div class="row">
                    <div class="col-12 ">
                        <div class="row ">

                            <div class="col-7">
                                <div class="name">
                                    <?php echo explode(' ', $post['username'])[0]; ?>
                                    <?php if ($post['birthday']) { ?>
                                        <span class="old">
                                                        <?php echo \frontend\components\YearHelper::Year((time() - $post['birthday']) / 31556926); ?>
                                                    </span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-5">
                                <?php

                                $city = City::getCity($post['city']);

                                ?>
                                <div class="city">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0002 12.9065C12.7974 12.9065 15.0649 10.6389 15.0649 7.84173C15.0649 5.04455 12.7974 2.77699 10.0002 2.77699C7.20299 2.77699 4.93542 5.04455 4.93542 7.84173C4.93542 10.6389 7.20299 12.9065 10.0002 12.9065Z" fill="#486BEF" stroke="#486BEF" stroke-miterlimit="10"/>
                                        <path d="M9.99989 10.8345C11.6528 10.8345 12.9927 9.4946 12.9927 7.84172C12.9927 6.18884 11.6528 4.84892 9.99989 4.84892C8.347 4.84892 7.00708 6.18884 7.00708 7.84172C7.00708 9.4946 8.347 10.8345 9.99989 10.8345Z" fill="white"/>
                                        <path d="M10 17.4101C9.8705 17.4101 9.68345 17.223 9.68345 17.223C4.21582 10.9353 4.93525 7.84173 4.93525 7.84173C4.93525 7.84173 6.51798 12.8921 10 12.9065" fill="#486BEF"/>
                                        <path d="M10 17.4101C10.1295 17.4101 10.3165 17.223 10.3165 17.223C15.7842 10.9353 15.0647 7.84173 15.0647 7.84173C15.0647 7.84173 13.482 12.8921 10 12.9065" fill="#486BEF"/>
                                    </svg>
                                    <?php echo $city['city'] ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row info-block celi-znakomsva-block">

                    <?php if ($post['about']) : ?>

                    <div class="col-12">
                        <p><?php echo $post['about']; ?></p>
                    </div>

                    <?php endif; ?>

                    <div class="col-12">

                        <div class="label fl_l">Цель знакомства:</div>

                        <div class="labeled">
                            <?php

                            if (isset($post['celiZnakomstvamstva'] )) :

                                foreach ($post['celiZnakomstvamstva'] as $item){
                                    echo '<a href="/znakomstva/celi-znakomstva-' . $item['url'] . '" > ' . $item['value'] . '</a>';
                                    if ($item != end($post['celiZnakomstvamstva'] )) echo ',';
                                }

                                else :

                                    echo 'Спроси меня'

                                ?>

                            <?php endif; ?>

                        </div>

                    </div>
                </div>

                <div class="like-wrap info-block">
                    <div class="row">
                        <div class=" col-6 col-md-6 col-lg-4 message-col">
                            <div class="message-wrap">

                                <div class="message write-message"
                                    <?php if (!Yii::$app->user->isGuest and (Yii::$app->user->id != $post['id'] )) : ?>
                                        onclick="get_message_form(this)"
                                        data-user-id="<?php echo $post['id']  ?>"
                                    <?php elseif (Yii::$app->user->isGuest) : ?>
                                        data-toggle="modal" data-target="#modal-in" aria-hidden="true"
                                    <?php endif; ?> >
                                    Написать
                                </div>

                                <?php
                                /*если пользователь не в друзьях и не отправлял заявку в друзья добавляем возможность добавление в друзья*/
                                if (Yii::$app->user->isGuest or
                                    (!FriendsHelper::isFiends(Yii::$app->user->id, $post['id'] )
                                        and !$isFriendsRequestFrom = FriendsRequestHelper::isFiendsRequest($post['id'] , Yii::$app->user->id)
                                        and !$isFriendsRequestTo = FriendsRequestHelper::isFiendsRequest(Yii::$app->user->id, $post['id'] ))) {
                                    $onclick = 'onclick="addToFriendsListing(this)"';
                                } else {
                                    $onclick = '';
                                }
                                if (Yii::$app->user->isGuest) {
                                    $onclick = 'data-toggle="modal" data-target="#modal-in" aria-hidden="true"';
                                }
                                ?>

                                <div data-id="<?php echo $post['id']  ?>" class="add-to-friends-listing message"
                                     data-message="<?php if (Yii::$app->user->isGuest) echo 'Требуется авторизация' ?>"
                                    <?php echo $onclick ?>>
                                    <?php if (!Yii::$app->user->isGuest and FriendsHelper::isFiends(Yii::$app->user->id, $post['id'] ) ) : ?>
                                        <span class="show-message" data-message="Ваш друг">
                                                         <i class="fas fa-user-friends"></i>
                                                    </span>
                                    <?php elseif (!Yii::$app->user->isGuest and isset($isFriendsRequestTo) and $isFriendsRequestTo) : ?>
                                        <span class="show-message" data-message="Заявка отправлена">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                    <?php elseif (!Yii::$app->user->isGuest and $isFriendsRequestFrom) : ?>
                                        <span class="show-message" data-message="Принять заявку" onclick="check_friend_request_listing(this)" data-user-id="<?php echo $post['id']  ?>">
                                                        <i class="fas fa-user-check"></i>
                                                    </span>
                                    <?php else : ?>
                                        <span class="show-message" data-message="Добавить в друзья" >
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>