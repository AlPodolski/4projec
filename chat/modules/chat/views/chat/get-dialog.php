<?php

/* @var $dialog_id integer */
/* @var $recepient integer */
/* @var $user array */

use chat\modules\chat\widgets\DialogWidget;

echo DialogWidget::widget(['dialog_id' => $dialog_id, 'user' => $user, 'recepient' => $recepient]);