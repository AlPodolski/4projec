<?php

/* @var $photo array */
/* @var $id integer */
/* @var $chat_id integer */

use yii\helpers\Html;

echo '<div class="row">';

if ($photo) foreach ($photo as $item) {

    echo '<div class="col-4">';

    $src = 'http://msk.'.Yii::$app->params['site_name'] . $item['file'];

    echo Html::img($src, ['width' => '250px', 'class' => 'img', 'loading' => 'lazy']);

    echo '<span onclick="send_photo_from_gallery(this)"
    data-img-id="'.$item['id'].'"
    class="btn btn-success" data-chat-id="'.$chat_id.'" data-from="'.$id.'">Отправить</span>';

    echo '</div>';

}
else echo 'Нет фото';

echo '</div>';