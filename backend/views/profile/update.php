<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\Profile */

$this->title = 'Изменить пользователя: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php

        $photo = \frontend\modules\user\models\Photo::find()->where(['user_id' => $model->id])->asArray()->all(); ?>

        <div class="row">

            <?php foreach ($photo as $item) : ?>

                <div class="admin-user-photo col-3 position-relative">

                    <?php if ($item['status'] == \frontend\modules\user\models\Photo::STATUS_DEFAULT) : ?>

                    <div class="action-photo"
                         data-photo-id="<?php echo $item['id'] ?>"
                         data-user-id="<?php echo $model->id ?>"
                         onclick="hide_photo(this)">Скрыть</div>

                    <?php elseif($item['status'] == \frontend\modules\user\models\Photo::STATUS_HIDE): ?>

                        <div class="action-photo"
                             data-photo-id="<?php echo $item['id'] ?>"
                             data-user-id="<?php echo $model->id ?>"
                             onclick="show_photo(this)">Показать</div>

                    <?php endif; ?>

                    <div class="action-photo main-photo"
                         data-photo-id="<?php echo $item['id'] ?>"
                         data-user-id="<?php echo $model->id ?>"
                         onclick="set_main(this)">
                        <?php if ($item['avatar'] == 1) : ?>
                            Главное фото
                        <?php else:  ?>
                            Сделать главной
                        <?php endif; ?>

                    </div>

                    <?php

                    $src = 'http://msk.'.Yii::$app->params['site_name'] . $item['file'];

                    echo Html::img($src, ['width' => '250px', 'class' => 'img', 'loading' => 'lazy']);

                    ?>

                </div>

            <?php endforeach; ?>

        </div>

</div>
