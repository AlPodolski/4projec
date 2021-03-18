<?php

/* @var $dialog array */
/* @var $user_id integer */

?>
<li class="dialog_item <?php if ($dialog->lastMessage['status'] == 0 and $dialog['lastMessage']['from'] != $user_id) echo 'not-read-dialog'; ?> ">
    <div class="row">
        <div class="col-2 col-md-1">
            <div class="dialog-photo">

                <?php if (file_exists(Yii::getAlias('@webroot') . $dialog->companion['author']['avatarRelation']['file']) and $dialog->companion['author']['avatarRelation']['file']) : ?>

                    <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($dialog->companion['author']['avatarRelation']['file'], 'dialog') ?>" alt="">

                <?php else : ?>

                    <img class="img" src="/files/img/nophoto.png" alt="">

                <?php endif; ?>

            </div>
        </div>
        <div class="col-10 col-md-11 nim-dialog--content position-relative">
            <div class="dialog-text">
                <div class="row">
                    <div class="col-12">
                        <div class="dialog-name">
                            <a href="/user/chat/<?php echo $dialog['dialog_id'] ?>"><?php echo $dialog['companion']['author']['username'] ?></a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="dialog-prewiew">
                            <div class="text-preview">
                                <a href="/user/chat/<?php echo $dialog['dialog_id'] ?>">
                                                    <span class="nim-dialog--who">
                                                        <span class="im-prebody">

                                                            <?php if ($dialog['lastMessage']['from'] != $user_id) : ?>

                                                                <?php if (file_exists(Yii::getAlias('@webroot') . $dialog['lastMessage']['author']['avatarRelation']['file']) and $dialog['lastMessage']['author']['avatarRelation']['file']) : ?>

                                                                    <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($dialog['lastMessage']['author']['avatarRelation']['file'], 'dialog') ?>" alt="">

                                                                <?php else : ?>

                                                                    <img class="img" src="/files/img/nophoto.png" alt="">

                                                                <?php endif; ?>

                                                            <?php endif; ?>

                                                        </span>
                                                    </span>
                                </a>
                                <a href="/user/chat/<?php echo $dialog['dialog_id'] ?>">
                                                            <span class="nim-dialog--inner-text <?php if ($dialog->lastMessage['status'] != 0) echo 'read-dialog'; ?> ">
                                                                <?php if (isset($dialog->lastMessage['class'])) : ?>

                                                                    <?php if ($dialog->lastMessage['class'] == \frontend\models\relation\UserPresents::class) : ?>

                                                                        <svg width="17" height="18" viewBox="0 0 27 28" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                                                            <path d="M10.8 12.88H1.07996V7.83997H25.92V12.88H16.2" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                                                            <path d="M16.2 7.83997H10.8V26.88H16.2V7.83997Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                                                            <path d="M10.14 12.4445H1.5V26.4445H24.18V12.4445H15.54" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                                                                            <path d="M13.4999 7.28C13.4999 7.28 11.5657 7.28 9.17995 7.28C6.79423 7.28 4.31995 5.83464 4.31995 3.36C4.31995 2.33632 4.79407 1.12 6.65221 1.12C10.3874 1.12 10.456 7.28 13.4999 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                                            <path d="M13.5 7.28C13.5 7.28 15.4343 7.28 17.82 7.28C20.2057 7.28 22.68 5.83464 22.68 3.36C22.68 2.33632 22.2059 1.12 20.3477 1.12C16.6126 1.12 16.544 7.28 13.5 7.28Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        </svg>

                                                                    <?php endif; ?>

                                                                    <?php if ($dialog->lastMessage['class'] == \frontend\models\Files::class) : ?>

                                                                        <svg width="28" height="28" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M21.2681 5.04C20.8289 4.57993 20.2224 4.30806 19.5323 4.30806H16.0608V4.26624C16.0608 3.74343 15.8517 3.24152 15.4962 2.90692C15.1407 2.55141 14.6597 2.34229 14.1369 2.34229H7.86312C7.31939 2.34229 6.8384 2.55141 6.48289 2.90692C6.12738 3.26244 5.91825 3.74343 5.91825 4.26624V4.30806H2.46768C1.77757 4.30806 1.1711 4.57993 0.731939 5.04C0.292776 5.47917 0 6.10654 0 6.77575V17.1902C0 17.8803 0.271863 18.4868 0.731939 18.9259C1.1711 19.3651 1.79848 19.6579 2.46768 19.6579H19.5323C20.2224 19.6579 20.8289 19.386 21.2681 18.9259C21.7072 18.4868 22 17.8594 22 17.1902V6.77575C22 6.08563 21.7281 5.47917 21.2681 5.04ZM20.9125 17.1902H20.8916C20.8916 17.5666 20.7452 17.9012 20.4943 18.1522C20.2433 18.4031 19.9087 18.5495 19.5323 18.5495H2.46768C2.09125 18.5495 1.75665 18.4031 1.5057 18.1522C1.25475 17.9012 1.10837 17.5666 1.10837 17.1902V6.77575C1.10837 6.39932 1.25475 6.06472 1.5057 5.81377C1.75665 5.56282 2.09125 5.41643 2.46768 5.41643H6.5038C6.81749 5.41643 7.06844 5.16548 7.06844 4.85179V4.24533C7.06844 4.01529 7.15209 3.80616 7.29848 3.65978C7.44487 3.51339 7.65399 3.42974 7.88403 3.42974H14.1369C14.3669 3.42974 14.576 3.51339 14.7224 3.65978C14.8688 3.80616 14.9525 4.01529 14.9525 4.24533V4.85179C14.9525 5.16548 15.2034 5.41643 15.5171 5.41643H19.5532C19.9297 5.41643 20.2643 5.56282 20.5152 5.81377C20.7662 6.06472 20.9125 6.39932 20.9125 6.77575V17.1902Z"
                                  fill="#486BEF"/>
                            <path d="M11 6.83838C9.5779 6.83838 8.28133 7.42393 7.36117 8.34408C6.42011 9.28515 5.85547 10.5608 5.85547 11.9829C5.85547 13.4049 6.44102 14.7015 7.36117 15.6216C8.30224 16.5627 9.5779 17.1274 11 17.1274C12.422 17.1274 13.7186 16.5418 14.6387 15.6216C15.5798 14.6806 16.1444 13.4049 16.1444 11.9829C16.1444 10.5608 15.5589 9.26423 14.6387 8.34408C13.7186 7.42393 12.422 6.83838 11 6.83838ZM13.8441 14.8479C13.1121 15.5589 12.1083 16.019 11 16.019C9.89159 16.019 8.88779 15.5589 8.15585 14.8479C7.42391 14.1159 6.98475 13.1121 6.98475 12.0038C6.98475 10.8954 7.44482 9.89161 8.15585 9.15967C8.88779 8.42773 9.89159 7.98857 11 7.98857C12.1083 7.98857 13.1121 8.44864 13.8441 9.15967C14.576 9.89161 15.0152 10.8954 15.0152 12.0038C15.0361 13.1121 14.576 14.1159 13.8441 14.8479Z"
                                  fill="#486BEF"/>
                            <path d="M18.4446 8.86681C19.0106 8.86681 19.4694 8.40803 19.4694 7.8421C19.4694 7.27616 19.0106 6.81738 18.4446 6.81738C17.8787 6.81738 17.4199 7.27616 17.4199 7.8421C17.4199 8.40803 17.8787 8.86681 18.4446 8.86681Z"
                                  fill="#486BEF"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="22" height="22" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>

                                                                    <?php endif; ?>

                                                                <?php else : ?>

                                                                    <?php echo $dialog->lastMessage['message'] ?>

                                                                <?php endif; ?>
                                                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="delete-dialog position-absolute " onclick="delete_dialog(this)" data-id="<?php echo $dialog['dialog_id'] ?>">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.25 14.75L14.75 1.25" stroke="black" stroke-width="2"/>
                    <path d="M1.25 1.25L14.75 14.75" stroke="black" stroke-width="2"/>
                </svg>
            </div>
            <?php if ($dialog['companion']['author']['vip_status_work'] > time()) : ?>
                <div class="vip-icon-wrap">
                    <img class="vip-icon" src="/files/img/vip_icon.png" alt="VIP">
                </div>
            <?php endif; ?>
        </div>
    </div>
</li>