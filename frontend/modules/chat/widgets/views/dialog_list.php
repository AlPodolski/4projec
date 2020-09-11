<?php /* @var $dialogs array */ ?>
<?php /* @var $user_id integer */ ?>
<?php /* @var $this \yii\web\View */ ?>
<?php $notVipDialogs = array()  ?>
<div class="dialog_list">


        <?php if (!empty($dialogs)) : ?>

            <ul class="dialog_item_ul">

                    <?php foreach ($dialogs as $dialog) : ?>

                        <?php if ($dialog['companion']['author']['vip_status_work'] > time()) : ?>

                            <?php echo $this->renderFile(Yii::getAlias('@app/modules/chat/widgets/views/dialog_list_item.php') , [
                                    'dialog'    => $dialog,
                                    'user_id'   => $user_id
                            ]) ;

                            ?>

                        <?php else: ?>

                        <?php $notVipDialogs[] = $dialog ?>

                        <?php endif; ?>

                    <?php endforeach; ?>

                    <?php foreach ($notVipDialogs as $dialog) : ?>

                            <?php echo $this->renderFile(Yii::getAlias('@app/modules/chat/widgets/views/dialog_list_item.php') , [
                                'dialog'    => $dialog,
                                'user_id'   => $user_id
                            ]) ;

                            unset($dialog);

                            ?>

                    <?php endforeach; ?>

            </ul>

        <?php else : ?>
           <div class="col-12">
               <p>У Вас пока нет диалогов</p>
           </div>
        <?php endif; ?>


</div>