<?php

/* @var $form_id string */
/* @var $countNotRead integer */
/* @var $countNotReadEvents integer */

/* @var $countFriendsRequest integer */

use frontend\modules\user\models\Photo;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="user-sidebar">

    <?php

    $photo = new Photo();

    $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data']]);

    ?>

    <?php $avatar = Photo::getAvatar(Yii::$app->user->id); ?>

    <div class="img-label-wrap">
        <span class="plus">
            <i class="fas fa-plus"></i>
        </span>
        <label for="<?php echo $form_id ?>" class="<?php if (isset($avatar->file)) echo '' ?>exist-img img-label">

            <?php if (isset($avatar->file)) : ?>

                <img loading="lazy" class="main-img" srcset="<?= Yii::$app->imageCache->thumbSrc($avatar->file , 'popular') ?>" alt="">

            <?php else : ?>

                <img class="main-img" src="">

            <?php endif; ?>

            <?= $form->field($photo, 'file')->fileInput(['maxlength' => true, 'accept' => 'image/*', 'id' => $form_id])->label(false) ?>

            <p class="form-text">Загрузите <br> свое фото </p>

        </label>
    </div>


    <div class="form-info">
        <p class="alert alert-success"></p>
    </div>

    <?php ActiveForm::end();  ?>

    <div class="user-menu-list">
        <ul class="user-menu-ul">
            <li class="user-menu-item my-page">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 15C19.866 15 23 11.866 23 8C23 4.13401 19.866 1 16 1C12.134 1 9 4.13401 9 8C9 11.866 12.134 15 16 15Z"
                          stroke="#486BEF" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M27 26C27 23.0826 25.8411 20.2847 23.7782 18.2218C21.7153 16.1589 18.9174 15 16 15C13.0826 15 10.2847 16.1589 8.22183 18.2218C6.15893 20.2847 5 23.0826 5 26V31H27V26Z"
                          stroke="#486BEF" stroke-width="2" stroke-linejoin="round"/>
                </svg>
                <span class="text ">
                    <a href="/user">Моя страница</a>
                </span>
            </li>
            <li class="user-menu-item my-page">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M33.2917 28.3333C33.2917 30.2897 31.7064 31.875 29.75 31.875H4.25001C2.29359 31.875 0.708344 30.2897 0.708344 28.3333V7.79166C0.708344 6.22695 1.97697 4.95833 3.54168 4.95833H17.8295L23.5663 2.88008C23.9296 2.74762 24.332 2.93533 24.4644 3.29729L25.0686 4.95833H27.625C29.1897 4.95833 30.4583 6.22695 30.4583 7.79166V9.20833C32.0231 9.20833 33.2917 10.477 33.2917 12.0417V28.3333ZM3.54168 6.375C2.75968 6.375 2.12501 7.00966 2.12501 7.79166C2.12501 8.57366 2.75968 9.20833 3.54168 9.20833H5.98189H6.11576C6.12497 9.20479 6.13064 9.197 6.13984 9.19345L13.9188 6.375H3.54168ZM24.1386 6.5032L23.3863 4.43204H23.3856L21.9328 4.95833H21.935L18.0292 6.375H18.0221L10.2028 9.20833H25.1218L24.1386 6.5032ZM29.0417 7.79166C29.0417 7.00966 28.407 6.375 27.625 6.375H25.5829L26.6128 9.20833H29.0417V7.79166ZM30.4583 10.625H3.54168C3.02318 10.625 2.54293 10.4755 2.12501 10.2319V28.3333C2.12501 29.507 3.07701 30.4583 4.25001 30.4583H29.75C30.9237 30.4583 31.875 29.507 31.875 28.3333V23.375H29.0417C27.477 23.375 26.2083 22.1064 26.2083 20.5417C26.2083 18.977 27.477 17.7083 29.0417 17.7083H31.875V12.0417C31.875 11.2597 31.2403 10.625 30.4583 10.625ZM31.875 21.9583V19.125H29.0417C28.2597 19.125 27.625 19.7597 27.625 20.5417C27.625 21.3237 28.2597 21.9583 29.0417 21.9583H31.875ZM29.0417 19.8333H30.4583V21.25H29.0417V19.8333Z" fill="#486BEF"/>
                </svg>
                <span class="text ">
                    <a href="/user/balance">
                        Баланс <?php echo Yii::$app->user->identity['cash'] ?>
                    </a></span></li>
            <li class="user-menu-item my-page">
                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M34.1016 32.6953C33.0078 32.3145 31.2207 32.1973 30.4395 31.8945C29.8926 31.6797 29.0234 31.4551 28.75 31.1133C28.4668 30.7813 28.4668 28.3691 28.4668 28.3691C28.4668 28.3691 29.1504 27.7344 29.4336 27.0215C29.7168 26.3086 29.9023 24.375 29.9023 24.375C29.9023 24.375 29.9609 24.3945 30.0488 24.3945C30.2539 24.3945 30.625 24.2578 30.8008 23.3594C31.0156 22.2559 31.4258 21.6797 31.3184 20.8691C31.2402 20.3223 31.0059 20.2344 30.8691 20.2344C30.8008 20.2344 30.752 20.2539 30.752 20.2539C30.752 20.2539 31.3086 19.4336 31.3086 16.6406C31.3086 13.7695 29.0918 10.9375 25 10.9277C20.8984 10.9375 18.6914 13.7695 18.6914 16.6406C18.6914 19.4238 19.248 20.2539 19.248 20.2539C19.248 20.2539 19.1992 20.2344 19.1309 20.2344C18.9844 20.2344 18.75 20.3223 18.6816 20.8691C18.5742 21.6797 18.9746 22.2656 19.1992 23.3594C19.375 24.2578 19.7461 24.3945 19.9512 24.3945C20.0391 24.3945 20.0977 24.375 20.0977 24.375C20.0977 24.375 20.2832 26.3184 20.5664 27.0215C20.8496 27.7344 21.5332 28.3691 21.5332 28.3691C21.5332 28.3691 21.5332 30.7813 21.25 31.1133C20.9668 31.4453 20.1074 31.6797 19.5605 31.8945C18.7793 32.1973 16.9922 32.3145 15.8984 32.6953C14.8047 33.0762 11.4258 34.668 11.4258 39.0625H38.5742C38.5742 34.668 35.2051 33.0762 34.1016 32.6953ZM14.3652 35.5078C15.2637 34.5605 16.2793 34.1602 16.3965 34.1211C16.8262 33.9746 17.5293 33.8574 18.1445 33.7598C18.877 33.6523 19.5605 33.5449 20.0977 33.3398C20.1953 33.3008 20.3223 33.252 20.459 33.2031C21.1523 32.959 21.9336 32.6855 22.4316 32.0996C22.8125 31.6504 22.9492 31.0352 23.0273 29.6875C23.0664 29.0039 23.0469 28.3789 23.0469 28.3496V27.6758L22.5684 27.2168C22.4609 27.1191 22.1094 26.7285 21.9922 26.4355C21.875 26.1426 21.7188 25.0488 21.6504 24.4336C21.5332 23.3105 21.0645 23.8965 20.7031 22.9492C20.5078 22.4414 20.4199 21.8359 20.2832 21.3672C20.1465 20.8887 20.9082 20.4688 20.7324 19.873C20.5469 19.2773 20.2441 18.5156 20.2441 16.6309C20.2441 14.6289 21.7383 12.5 24.9902 12.4902C28.2422 12.4902 29.7363 14.6289 29.7363 16.6309C29.7363 18.5156 29.4336 19.2773 29.248 19.873C29.0625 20.4688 29.834 20.8887 29.6973 21.3672C29.5605 21.8457 29.4727 22.4414 29.2773 22.9492C28.9062 23.8965 28.4473 23.3105 28.3301 24.4336C28.2617 25.0488 28.1055 26.1328 27.9883 26.4355C27.8711 26.7285 27.5293 27.1191 27.4219 27.2168L26.9531 27.6758V28.3496C26.9531 28.3789 26.9336 29.0039 26.9629 29.6875C27.041 31.0352 27.168 31.6504 27.5488 32.0996C28.0469 32.6855 28.8281 32.959 29.5215 33.2031C29.6582 33.252 29.7852 33.3008 29.8828 33.3398C30.4199 33.5449 31.1133 33.6523 31.8359 33.7598C32.4512 33.8477 33.1543 33.9648 33.584 34.1211C33.7012 34.1602 34.7168 34.5703 35.6152 35.5078C36.1914 36.1133 36.5918 36.6211 36.8164 37.5H13.1738C13.3887 36.6211 13.7891 36.123 14.3652 35.5078Z" fill="#486BEF"/>
                    <path d="M14.0723 31.4453C14.9512 31.0059 15.8105 31.0059 16.4746 30.918C16.4746 30.918 16.8457 30.3125 15.625 30.0977C15.625 30.0977 13.9551 29.6777 13.7598 29.4434C13.5645 29.209 13.6816 27.9102 13.6816 27.9102C13.6816 27.9102 16.0156 27.832 16.9434 27.0117C15.4297 24.7461 16.2402 22.0996 15.9277 19.6289C15.625 17.168 14.1504 15.625 11.3281 15.625C11.3184 15.625 11.3281 15.625 11.2305 15.625C8.49609 15.625 7.08984 17.168 6.77734 19.6387C6.46484 22.1094 7.36328 25.0488 5.81055 27.0312C6.67969 27.8027 8.82812 27.8418 9.07227 27.8418C9.0918 27.8418 9.0918 27.8418 9.0918 27.8418L9.10156 27.832C9.10156 27.832 9.19922 29.2188 9.00391 29.4531C8.80859 29.6875 8.23242 29.9023 7.8418 29.9902C6.98242 30.1758 6.07422 30.4785 5.32227 30.7422C4.57031 30.9961 3.125 32.5195 3.125 34.375H10.957C11.1719 33.5938 12.6465 32.168 14.0723 31.4453ZM10.0391 32.8125H5.26367C5.49805 32.4219 5.74219 32.2461 5.86914 32.1777C6.5625 31.9336 7.40234 31.6797 8.18359 31.5137C8.51563 31.4453 9.62891 31.1523 10.2148 30.4492C10.5078 30.1074 10.8008 29.5703 10.6641 27.7148L10.6055 26.3184L9.20898 26.2695H9.10156H9.04297C8.68164 26.2695 8.32031 26.2305 7.99805 26.1816C8.4082 24.8535 8.36914 23.4277 8.32031 22.1289C8.29102 21.2988 8.27148 20.4785 8.35938 19.7852C8.58398 18.0078 9.44336 17.0898 11.2207 17.0898H11.2402H11.2891C13.2422 17.0898 14.1602 17.9883 14.3945 19.7949C14.4824 20.4883 14.4727 21.25 14.4531 22.041C14.4238 23.3496 14.3945 24.7852 14.8535 26.2109C14.8145 26.2207 14.7852 26.2305 14.7461 26.2402C14.1602 26.3477 13.6523 26.3672 13.6523 26.3672L12.2754 26.416L12.1484 27.7832C11.9922 29.4922 12.2656 30.0781 12.5781 30.4492C12.5879 30.459 12.5879 30.459 12.5977 30.4688C12.041 30.8203 11.4941 31.2891 11.0059 31.7383C10.6055 32.0801 10.293 32.4219 10.0391 32.8125Z" fill="#486BEF"/>
                    <path d="M39.043 34.375H46.875C46.875 32.5195 45.4297 30.9961 44.6777 30.7324C43.9258 30.4688 43.0078 30.166 42.1582 29.9805C41.7578 29.8926 41.1914 29.6777 40.9961 29.4434C40.8008 29.209 40.8984 27.8223 40.8984 27.8223L40.9082 27.832C40.9082 27.832 40.918 27.832 40.9277 27.832C41.1719 27.832 43.3301 27.8027 44.1992 27.0215C42.6465 25.0391 43.5352 22.0996 43.2227 19.6289C42.9102 17.168 41.5039 15.625 38.7695 15.625C38.6719 15.625 38.6719 15.625 38.6719 15.625C35.8496 15.625 34.3652 17.168 34.0625 19.6387C33.75 22.1094 34.5605 24.7559 33.0469 27.0215C33.9746 27.8418 36.3086 27.9199 36.3086 27.9199C36.3086 27.9199 36.4258 29.2188 36.2305 29.4531C36.0352 29.6875 34.3652 30.1074 34.3652 30.1074C33.1445 30.3223 33.5156 30.9277 33.5156 30.9277C34.1797 31.0156 35.0488 31.0156 35.918 31.4551C37.3535 32.168 38.8281 33.5938 39.043 34.375ZM39.0039 31.7285C38.5156 31.2793 37.9688 30.8105 37.4121 30.459C37.4219 30.4492 37.4219 30.4492 37.4316 30.4395C37.7441 30.0586 38.0176 29.4727 37.8613 27.7734L37.7344 26.4062L36.3574 26.3574C36.3574 26.3574 35.8496 26.3379 35.2637 26.2305C35.2246 26.2207 35.1855 26.2109 35.1563 26.2012C35.6152 24.7852 35.5859 23.3398 35.5566 22.0313C35.5371 21.2402 35.5273 20.4785 35.6152 19.7852C35.8398 17.9785 36.7676 17.0801 38.7207 17.0801H38.7695H38.7891C40.5664 17.0801 41.416 17.998 41.6504 19.7754C41.7383 20.4688 41.709 21.2891 41.6895 22.1191C41.6504 23.418 41.6016 24.8438 42.0117 26.1719C41.6895 26.2207 41.3281 26.2598 40.9668 26.2598H40.9082H40.8008L39.3945 26.2988L39.3359 27.6953C39.1992 29.5605 39.502 30.0879 39.7852 30.4297C40.3711 31.1328 41.4941 31.4258 41.8164 31.4941C42.5879 31.6602 43.4375 31.9141 44.1309 32.1582C44.2578 32.2266 44.502 32.4023 44.7363 32.793H39.9609C39.707 32.4219 39.3945 32.0801 39.0039 31.7285Z" fill="#486BEF"/>
                </svg>


                <span class="text ">
                    <a href="/user/friends/<?php echo Yii::$app->user->id; ?>">Мои друзья <?php if ($countFriendsRequest > 0) echo '+' . $countFriendsRequest ?></a>
                </span>
            </li>
            <li class="user-menu-item my-message message-li position-relative">
                <spn class="position-relative">
                    <?php if ($countNotRead > 0) : ?>
                        <span class="show-event"></span>
                    <?php endif; ?>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M31.36 5.12H0.640015V26.88H31.36V5.12Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                            <path d="M21.3485 16.4237L31.2896 24.2835" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10"/>
                            <path d="M0.710388 24.2829L11.0822 16.0813" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10"/>
                            <path d="M0.710388 7.71393C0.710388 7.71393 12.4864 17.9776 13.4457 18.8128C14.4051 19.648 15.4041 19.84 16 19.84C16.5958 19.84 17.5949 19.6486 18.5542 18.8134C19.5136 17.9782 31.2896 7.71457 31.2896 7.71457" stroke="#486BEF" stroke-width="1.9959" stroke-miterlimit="10"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="32" height="32" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </spn>

                <span class="text ">
                    <a href="/user/chat">Мои сообщения</a>
                </span>
            </li>
            <li class="user-menu-item my-message position-relative">

                <span class="position-relative">
                     <?php if ($countNotReadEvents > 0) : ?>
                         <span class="show-event"></span>
                     <?php endif; ?>
                <svg  width="24" height="30" viewBox="0 0 24 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7633 21.7594L19.5516 9.29999C19.4276 7.98874 18.9605 6.73326 18.1973 5.65983C17.4341 4.58641 16.4017 3.73289 15.2039 3.18515C15.1813 2.35073 14.834 1.55806 14.2358 0.975859C13.6377 0.393656 12.8359 0.0678864 12.0012 0.0678864C11.1664 0.0678864 10.3647 0.393656 9.76651 0.975859C9.16835 1.55806 8.82101 2.35073 8.79844 3.18515C7.60103 3.73407 6.56902 4.58821 5.80593 5.66188C5.04284 6.73556 4.5755 7.99102 4.45078 9.30233L3.23438 21.7734C2.36178 21.86 1.55246 22.2677 0.963473 22.9173C0.374482 23.5669 0.0478198 24.4122 0.046875 25.2891V26.1961C0.046875 26.3826 0.120954 26.5614 0.252815 26.6933C0.384677 26.8251 0.56352 26.8992 0.75 26.8992H6.91406C7.39409 27.8347 8.12283 28.6197 9.02014 29.1678C9.91744 29.7159 10.9485 30.0059 12 30.0059C13.0515 30.0059 14.0826 29.7159 14.9799 29.1678C15.8772 28.6197 16.6059 27.8347 17.0859 26.8992H23.25C23.4365 26.8992 23.6153 26.8251 23.7472 26.6933C23.879 26.5614 23.9531 26.3826 23.9531 26.1961V25.1016C23.9506 24.2419 23.6183 23.4161 23.0248 22.7942C22.4313 22.1724 21.6218 21.802 20.7633 21.7594ZM12 1.40624C12.386 1.40567 12.7619 1.52934 13.0721 1.75896C13.3823 1.98857 13.6104 2.31194 13.7227 2.68124C12.5896 2.42255 11.4128 2.42255 10.2797 2.68124C10.3918 2.31233 10.6195 1.98924 10.9293 1.75965C11.2391 1.53007 11.6144 1.40617 12 1.40624ZM12 28.5937C11.3355 28.5947 10.6797 28.4415 10.0844 28.1462C9.48903 27.851 8.97023 27.4217 8.56875 26.8922H15.4336C15.0325 27.4227 14.5135 27.8527 13.9175 28.148C13.3216 28.4433 12.6651 28.5959 12 28.5937ZM22.5469 25.4859H1.45312V25.282C1.45869 24.7198 1.68625 24.1826 2.0862 23.7875C2.48615 23.3924 3.02607 23.1714 3.58828 23.1726H3.87422C4.0495 23.1735 4.21877 23.1088 4.34884 22.9913C4.47891 22.8738 4.5604 22.712 4.57734 22.5375L5.85 9.44765C5.95594 8.31115 6.3781 7.22704 7.06864 6.31819C7.75918 5.40935 8.69049 4.71209 9.75703 4.30546H9.78047C11.2076 3.76983 12.7806 3.76983 14.2078 4.30546L14.2828 4.33358C15.3364 4.74327 16.2558 5.43701 16.9389 6.33772C17.622 7.23844 18.042 8.31088 18.1523 9.43593L19.425 22.5258C19.4419 22.7002 19.5234 22.8621 19.6535 22.9796C19.7836 23.0971 19.9528 23.1618 20.1281 23.1609H20.5969C21.1126 23.1603 21.6075 23.3643 21.9731 23.7281C22.3387 24.0919 22.545 24.5858 22.5469 25.1016V25.4859Z" fill="#486BEF"/>
                </svg>
                </span>


                <span class="text">
                    <a  href="/user/events">Уведомления</a>
                </span>
            </li>

            <li class="user-menu-item my-message position-relative">
                <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.5089 2.87129C24.9218 1.06428 22.7706 0.0433774 20.524 0.0310334C18.2775 0.0186893 16.1177 1.01591 14.5153 2.80539C12.9107 0.997861 10.7401 -0.0112346 8.48086 9.43709e-05C6.22165 0.0114234 4.05893 1.04225 2.46848 2.8658C0.878023 4.68935 -0.0098854 7.15625 8.30375e-05 9.72382C0.0100515 12.2914 0.91708 14.7493 2.52163 16.5568L2.6666 16.7106L2.72459 16.7875L12.737 28.1664C13.2096 28.7003 13.8489 29 14.5153 29C15.1816 29 15.8209 28.7003 16.2935 28.1664L25.7744 17.3916L25.871 17.2927L26.3156 16.7765L26.4702 16.6117C27.2685 15.7136 27.9028 14.6452 28.3369 13.4678C28.7711 12.2904 28.9964 11.0272 29 9.75063C29.0035 8.47406 28.7853 7.20925 28.3579 6.02873C27.9304 4.84821 27.3021 3.77522 26.5089 2.87129V2.87129ZM25.1462 14.9971L25.0012 15.1509L24.8563 15.3267L24.576 15.6562L24.489 15.744L14.9212 26.6068C14.8128 26.7275 14.667 26.7952 14.5153 26.7952C14.3635 26.7952 14.2178 26.7275 14.1094 26.6068L4.19359 15.3376C4.12764 15.2517 4.0566 15.1709 3.98097 15.096C3.94439 15.069 3.91178 15.0357 3.88433 14.9971C2.7212 13.5788 2.08815 11.7025 2.11862 9.76396C2.14909 7.82542 2.84071 5.97606 4.04767 4.6058C5.25462 3.23553 6.8826 2.45144 8.58837 2.41882C10.2941 2.3862 11.9444 3.10761 13.1912 4.43096L13.2782 4.54079L13.3749 4.6726L13.8291 5.18882C13.9189 5.29177 14.0258 5.37348 14.1436 5.42924C14.2614 5.48501 14.3877 5.51372 14.5153 5.51372C14.6428 5.51372 14.7692 5.48501 14.8869 5.42924C15.0047 5.37348 15.1116 5.29177 15.2014 5.18882L15.6557 4.6726C15.6557 4.6726 15.7523 4.56276 15.7813 4.50784L15.849 4.41997C17.0831 3.01881 18.7565 2.23222 20.501 2.23325C22.2455 2.23428 23.9181 3.02285 25.151 4.42547C26.3839 5.82809 27.0761 7.72987 27.0751 9.71244C27.0742 11.695 26.3804 13.596 25.1462 14.9971V14.9971Z" fill="#496DF0"/>
                </svg>

                <span class="text ">
                    <a href="/user/sympathy">Симпатии</a>
                </span>

                <span class="filter-sympathy-icon" onclick="get_sympathy_settings_form(this)">
                    <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.75 7.75H8.43036C8.76593 9.04523 9.93427 10.0088 11.333 10.0088C12.7318 10.0088 13.9001 9.04523 14.2357 7.75H24.25C24.6641 7.75 25 7.41406 25 7C25 6.58594 24.6641 6.25 24.25 6.25H14.2357C13.9001 4.95477 12.7318 3.99121 11.333 3.99121C9.93427 3.99121 8.76593 4.95477 8.43036 6.25H1.75C1.33594 6.25 1 6.58594 1 7C1 7.41406 1.33594 7.75 1.75 7.75ZM11.333 5.49121C12.165 5.49121 12.8418 6.16797 12.8418 7C12.8418 7.83203 12.165 8.50879 11.333 8.50879C10.501 8.50879 9.82422 7.83203 9.82422 7C9.82422 6.16797 10.501 5.49121 11.333 5.49121Z" fill="#486BEF"/>
                        <path d="M24.25 12.25H22.6439C22.3083 10.9548 21.14 9.99121 19.7412 9.99121C18.3425 9.99121 17.1741 10.9548 16.8386 12.25H1.75C1.33594 12.25 1 12.5859 1 13C1 13.4141 1.33594 13.75 1.75 13.75H16.8386C17.1741 15.0452 18.3425 16.0088 19.7412 16.0088C21.14 16.0088 22.3083 15.0452 22.6439 13.75H24.25C24.6641 13.75 25 13.4141 25 13C25 12.5859 24.6641 12.25 24.25 12.25ZM19.7412 14.5088C18.9092 14.5088 18.2324 13.832 18.2324 13C18.2324 12.168 18.9092 11.4912 19.7412 11.4912C20.5732 11.4912 21.25 12.168 21.25 13C21.25 13.832 20.5732 14.5088 19.7412 14.5088Z" fill="#486BEF"/>
                        <path d="M24.25 18.25H9.71814C9.38263 16.9548 8.21436 15.9912 6.81641 15.9912C5.41766 15.9912 4.24933 16.9548 3.91376 18.25H1.75C1.33594 18.25 1 18.5859 1 19C1 19.4141 1.33594 19.75 1.75 19.75H3.91376C4.24933 21.0452 5.41766 22.0088 6.81641 22.0088C8.21436 22.0088 9.38263 21.0452 9.71814 19.75H24.25C24.6641 19.75 25 19.4141 25 19C25 18.5859 24.6641 18.25 24.25 18.25ZM6.81641 20.5088C5.98438 20.5088 5.30762 19.832 5.30762 19C5.30762 18.168 5.98438 17.4912 6.81641 17.4912C7.64746 17.4912 8.32422 18.168 8.32422 19C8.32422 19.832 7.64746 20.5088 6.81641 20.5088Z" fill="#486BEF"/>
                    </svg>
                </span>

                <div class="dropdown position-absolute sympathy-settings-form-wrap d-none">

                </div>

            </li>

            <li class="user-menu-item my-advert">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M28 15.3333C28.0046 17.0932 27.5934 18.8292 26.8 20.4C25.8592 22.2823 24.413 23.8656 22.6233 24.9724C20.8335 26.0792 18.771 26.6659 16.6667 26.6667C14.9068 26.6713 13.1708 26.2601 11.6 25.4667L4 28L6.53333 20.4C5.73991 18.8292 5.32875 17.0932 5.33333 15.3333C5.33415 13.229 5.92082 11.1665 7.02763 9.37674C8.13444 7.58701 9.71767 6.14076 11.6 5.20001C13.1708 4.40658 14.9068 3.99542 16.6667 4.00001H17.3333C20.1125 4.15333 22.7374 5.32636 24.7055 7.29449C26.6737 9.26262 27.8467 11.8875 28 14.6667V15.3333Z" stroke="#486BEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="text " data-toggle="modal" data-target="#addAdvertModal">
                    <a href="#">Добавить объявление</a>
                </span>
            </li>
            <li class="user-menu-item my-advert">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M28 15.3333C28.0046 17.0932 27.5934 18.8292 26.8 20.4C25.8592 22.2823 24.413 23.8656 22.6233 24.9724C20.8335 26.0792 18.771 26.6659 16.6667 26.6667C14.9068 26.6713 13.1708 26.2601 11.6 25.4667L4 28L6.53333 20.4C5.73991 18.8292 5.32875 17.0932 5.33333 15.3333C5.33415 13.229 5.92082 11.1665 7.02763 9.37674C8.13444 7.58701 9.71767 6.14076 11.6 5.20001C13.1708 4.40658 14.9068 3.99542 16.6667 4.00001H17.3333C20.1125 4.15333 22.7374 5.32636 24.7055 7.29449C26.6737 9.26262 27.8467 11.8875 28 14.6667V15.3333Z" stroke="#486BEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="text ">
                    <a href="/adverts">Объявление</a>
                </span>
            </li>
            <li class="user-menu-item my-settings">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path d="M34.3 19.5678V15.3678L29.3013 14.5509C29.0052 13.3672 28.5404 12.2542 27.9279 11.235L30.8413 7.08261L27.8712 4.11391L23.772 7.06091C22.75 6.44211 21.63 5.97031 20.4379 5.67351L19.5664 0.69931H15.3664L14.5572 5.65741C13.3644 5.95001 12.2381 6.41551 11.2133 7.03151L7.12601 4.11111L4.15591 7.07981L7.03081 11.1916C6.40921 12.2206 5.93671 13.3455 5.63641 14.546L0.700012 15.3678V19.5678L5.63081 20.4421C5.92831 21.6398 6.40151 22.7647 7.02521 23.7951L4.11111 27.8712L7.07981 30.8427L11.1965 27.9594C12.2241 28.5768 13.3476 29.0458 14.5404 29.3405L15.3664 34.3014H19.5664L20.4491 29.3279C21.6356 29.0269 22.757 28.5544 23.7748 27.9349L27.9202 30.8434L30.8896 27.8719L27.9307 23.7629C28.5432 22.7437 29.008 21.6293 29.3013 20.4456L34.3 19.5678ZM17.5 23.1C14.4074 23.1 11.9 20.5926 11.9 17.5C11.9 14.4074 14.4074 11.9 17.5 11.9C20.5926 11.9 23.1 14.4074 23.1 17.5C23.1 20.5926 20.5926 23.1 17.5 23.1Z" stroke="#486BEF" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="35" height="35" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>

                <span class="text "><a href="/user/setting/anket">Настройки анкеты</a>
                </span>
            </li>
            <li class="user-menu-item my-logout">
                <?php echo ''
                    . Html::beginForm(['/user/logout'], 'post')
                    . Html::submitButton(
                        '<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.5 27.5H23.75C24.413 27.5 25.0489 27.2366 25.5178 26.7678C25.9866 26.2989 26.25 25.663 26.25 25V5C26.25 4.33696 25.9866 3.70107 25.5178 3.23223C25.0489 2.76339 24.413 2.5 23.75 2.5H17.5" stroke="#486BEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.75 20L18.75 15L13.75 10" stroke="#486BEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M18.75 15H3.75" stroke="#486BEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                     Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => ' btn-viiti btn text']
                    )
                    . Html::endForm()
                    . '' ?>
            </li>
        </ul>
    </div>


</div>