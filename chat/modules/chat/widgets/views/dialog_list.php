<?php use yii\helpers\Html; ?>
<?php /* @var $dialogs array */ ?>
<?php /* @var $user_id integer */ ?>
<h1 class="h1">Диалоги</h1>
<div class="dialog_list">


        <?php if (!empty($dialogs)) : ?>

    <ul class="dialog_item_ul">

            <?php foreach ($dialogs as $dialog) : ?>

            <?php if ($dialog) : ?>

                <li class="dialog_item dialog-item-<?php echo $dialog['dialog_id'] ?> <?php if ($dialog->lastMessage['status'] == 0 and !in_array($dialog['lastMessage']['from'] , $user_id)) echo 'not-read-dialog'; ?> ">
                <div class="row">
                    <div class="col-2 col-md-1">
                        <div class="dialog-photo">

                            <?php  $src = 'http://msk.'.Yii::$app->params['site_name'] ; ?>

                            <a target="_blank"  href="<?php echo $src ?>/user/<?php echo $dialog->companion['author']['id'] ?>">

                                <?php

                                    $src = 'http://msk.'.Yii::$app->params['site_name'] .$dialog->companion['author']['avatarRelation']['file'];

                                    echo Html::img($src, ['width' => '50px', 'class' => 'img']);

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

                                                        <?php if (!in_array( $dialog['lastMessage']['from'], $user_id)) : ?>

                                                            <?php

                                                            $src = 'http://msk.'.Yii::$app->params['site_name'] .$dialog['lastMessage']['author']['avatarRelation']['file'];

                                                            echo Html::img($src, ['width' => '50px', 'class' => 'img']);

                                                            ?>

                                                        <?php endif; ?>

                                                    </span>
                                                </span>
                                            </a>
                                            <a href="/user/chat/<?php echo $dialog['dialog_id'] ?>">
                                                <span class="nim-dialog--inner-text <?php if ($dialog->lastMessage['status'] != 0) echo 'read-dialog'; ?> "><?php echo $dialog->lastMessage['message'] ?></span>
                                            </a>
                                        </div>
                                        <div class="message write-message" data-dialog-id="<?php echo $dialog['dialog_id'] ?>" onclick="get_message_form(this)" data-user-id="<?php echo $dialog->companion['author']['id'] ?>">
                                            Написать
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </li>

            <?php endif; ?>

        <?php endforeach; ?>

    </ul>

        <?php else : ?>
           <div class="col-12">
               <p>У Вас пока нет диалогов</p>
           </div>
        <?php endif; ?>


</div>