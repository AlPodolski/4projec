<?php /* @var $dialogs array */ ?>
<div class="dialog_list">
    <ul class="dialog_item_ul">
        <?php //d($dialogs); ?>

        <?php foreach ($dialogs as  $dialog) : ?>

            <li class="dialog_item">
                <div class="row">
                    <div class="col-1">
                        <div class="dialog-photo">

                                <?php if (file_exists(Yii::getAlias('@webroot').$dialog->companion['avatarRelation']['file']) and $dialog->companion['avatarRelation']['file']) : ?>

                                    <?= Yii::$app->imageCache->thumb($dialog->companion['avatarRelation']['file'], 'dialog', ['class'=>'img']) ?>

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
                                        <span class="nim-dialog--who">
                                            <span class="im-prebody">
                                                <?php if (file_exists(Yii::getAlias('@webroot').$dialog['lastMessage']['author']['avatarRelation']['file']) and $dialog['lastMessage']['author']['avatarRelation']['file']) : ?>

                                                    <?= Yii::$app->imageCache->thumb($dialog['lastMessage']['author']['avatarRelation']['file'], 'dialog', ['class'=>'img']) ?>

                                                <?php else : ?>

                                                    <img class="img" src="/files/img/nophoto.png" alt="">

                                                <?php endif; ?>
                                            </span>
                                        </span>
                                            <span class="nim-dialog--inner-text <?php if ($dialog->lastMessage['status'] != 0) echo 'read-dialog';  ?> "><?php echo $dialog->lastMessage['message'] ?></span>
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