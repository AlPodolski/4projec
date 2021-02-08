<?php

use yii\helpers\Html;

/* @var $userDialog array */ ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Фото</th>
            <th scope="col">Диалогов</th>
        </tr>
        </thead>
        <tbody>

<? foreach ($userDialog as $userDialogItem){ ?>

    <tr>
        <th scope="row"><?php echo $userDialogItem['user_id'] ?></th>
        <td><?php echo $userDialogItem['user']['username'] ?></td>
        <td><?php echo Html::img('http://msk.'.Yii::$app->params['site_name'] .$userDialogItem['user']['avatarRelation']['file'], ['width' => '50px']) ?></td>
        <td><?php echo $userDialogItem['counted'] ?></td>
    </tr>

<?php } ?>

        </tbody>
    </table>
