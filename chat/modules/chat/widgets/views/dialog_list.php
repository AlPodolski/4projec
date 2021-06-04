<?php use yii\helpers\Html; ?>
<?php /* @var $dialogs array */ ?>
<?php /* @var $user_id integer */ ?>
<h1 class="h1">Диалоги</h1>
<div class="dialog_list">


        <?php if (!empty($dialogs) ) : ?>

        <?php $i = 0; ?>

        <ul class="dialog_item_ul">

            <?php foreach ($dialogs as $dialog) : ?>

            <?php if ($dialog and $dialog['lastMessage']['status'] == 0 and $dialog['lastMessage']['author']['fake'] == 1) : ?>

                <?php $i++; ?>

                <li class="dialog_item dialog-item-<?php echo $dialog['dialog_id'] ?> <?php if ($dialog->lastMessage['status'] == 0 ) echo 'not-read-dialog'; ?> ">
                <div class="row">
                    <div class="col-2 col-md-1">
                        <div class="dialog-photo">

                            <?php  $src = 'http://msk.'.Yii::$app->params['site_name'] ; ?>

                            <a target="_blank"  href="<?php echo $src ?>/user/<?php echo $dialog->companion['author']['id'] ?>">

                                <?php

                                    $src = 'http://msk.'.Yii::$app->params['site_name'] .$dialog->companion['author']['avatarRelation']['file'];

                                    echo Html::img($src, ['width' => '50px', 'class' => 'img', 'loading' => 'lazy']);

                                ?>

                            </a>

                        </div>
                    </div>
                    <div class="col-8 col-md-11 nim-dialog--content">
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
                                            <a target="_blank" href="<?php echo 'http://msk.'.Yii::$app->params['site_name'] ?>/user/chat/<?php echo $dialog['dialog_id'] ?>">
                                                <span class="nim-dialog--who">
                                                    <span class="im-prebody">

                                                         <?php if ( $dialog['lastMessage']['from'] == $dialog['user_id']) : ?>

                                                             <?php

                                                             $src = 'http://msk.'.Yii::$app->params['site_name'] .$dialog['lastMessage']['author']['avatarRelation']['file'];

                                                             echo Html::img($src, ['width' => '50px', 'class' => 'img', 'loading' => 'lazy']);

                                                             ?>

                                                         <?php endif; ?>

                                                    </span>
                                                </span>
                                            </a>
                                            <a href="#">
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

                                                           <i class="fas fa-camera"></i>

                                                       <?php endif; ?>

                                                   <?php else : ?>

                                                       <?php echo $dialog->lastMessage['message'] ?>

                                                   <?php endif; ?>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="message write-message" data-dialog-id="<?php echo $dialog['dialog_id'] ?>"
                                             onclick="get_message_form(this);ym(57612607,'reachGoal','open_<?php echo Yii::$app->params['id_'.Yii::$app->user->id] ?: 'alina' ?>')"
                                             data-user-id="<?php echo $dialog->companion['author']['id'] ?>">
                                            Написать
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="open-date open-date-<?php echo $dialog['dialog_id'] ?>">

                    </div>
                </div>
            </li>

            <?php endif; ?>

        <?php endforeach; ?>

    </ul>

        <?php echo $i ?>

        <?php else : ?>
           <div class="col-12">
               <p>У Вас пока нет диалогов</p>
           </div>
        <?php endif; ?>


</div>