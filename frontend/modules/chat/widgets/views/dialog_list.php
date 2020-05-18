<?php /* @var $dialogs array */ ?>
<?php /* @var $user_id integer */ ?>
<div class="dialog_list">
    <ul class="dialog_item_ul">


        <?php foreach ($dialogs as $dialog) : ?>

            <li class="dialog_item <?php if ($dialog->lastMessage['status'] == 0 and $dialog['lastMessage']['from'] != $user_id) echo 'not-read-dialog'; ?> ">
                <div class="row">
                    <div class="col-1">
                        <div class="dialog-photo">

                            <?php if (file_exists(Yii::getAlias('@webroot') . $dialog->companion['author']['avatarRelation']['file']) and $dialog->companion['author']['avatarRelation']['file']) : ?>

                                <img loading="lazy" class="img" srcset="<?= Yii::$app->imageCache->thumbSrc($dialog->companion['author']['avatarRelation']['file'], 'dialog') ?>" alt="">

                            <?php else : ?>

                                <img class="img" src="/files/img/nophoto.png" alt="">

                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-11 nim-dialog--content">
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
                                                <span class="nim-dialog--inner-text <?php if ($dialog->lastMessage['status'] != 0) echo 'read-dialog'; ?> "><?php echo $dialog->lastMessage['message'] ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </li>

        <?php endforeach; ?>
    </ul>
</div>