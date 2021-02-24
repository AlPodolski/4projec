<?php


use common\models\Params;
use common\models\Price;
use frontend\modules\user\models\Photo;
use frontend\modules\user\models\Profile;
use frontend\assets\SlickAsset;

/* @var $model Profile */
/* @var $group array */
/* @var $userFriends array */
/* @var $userHeart array */
/* @var $this \yii\web\View */


$this->registerJsFile('/files/js/owl.carousel.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile('/files/js/owl.navigation.js', ['depends' => [\frontend\assets\AppAsset::className()]]);


$this->registerCssFile('/css/owl.carousel.min.css');
$this->registerCssFile('/css/owl.theme.default.min.css');

$this->registerJsFile('/files/js/single.js?v=20', ['depends' => [\frontend\assets\AppAsset::className()]]);

$photo = Photo::getUserphoto($model->id);
$params = Params::find()->asArray()->all();
$price = Price::find()->asArray()->all();

$metro = $model->getMetro();
$rayon = $model->getRayon();

$addWallForm = new \frontend\modules\wall\models\forms\AddToWallForm();

$userPresent = null;

if ($model) {
    $service = $model->getService();
    $postPrice = $model->getUserPrice();
}
//фото для формы отправки сообщения
if (!Yii::$app->user->isGuest) {

    $userPresent = \frontend\models\relation\UserPresents::find()->where(['to' => $model->id])->with('present')->all();

    $userPhoto = Photo::getAvatar(Yii::$app->user->id);

}

\frontend\assets\LightGalleryAsset::register($this);
?>

<div class="anket <?php if (Yii::$app->user->isGuest) echo 'isGuest'?>" data-id="<?php echo $model->id ?>">

    <?php

    $cookies = Yii::$app->request->cookies;

    if ( Yii::$app->user->isGuest and ($cookie = $cookies->get('invitation-message') === null)) : ?>

    <div class="message-event d-none" >
        <div class="row">
            <div class="col-12 new-message-text" onclick="get_invitation_message_form(this);ym(57612607,'reachGoal','chat')">
                Новое сообщение
            </div>
            <div class="col-3" onclick="get_invitation_message_form(this);ym(57612607,'reachGoal','chat')">
                <a class="post_image">
                    <img loading="lazy" class="img" srcset="" alt="">
                </a>
            </div>
            <div class="col-9" onclick="get_invitation_message_form(this);ym(57612607,'reachGoal','chat')">
                <div class="row">
                    <div class="col-12 message-text">

                    </div>
                </div>
            </div>
        </div>
        <div class="close-message" onclick="close_message_event(this)">
            <i class="fas fa-times"></i>
        </div>
    </div>

    <?php endif; ?>

    <?php echo $this->renderFile('@app/views/anket/item.php',
        [
            'model' => $model,
            'group' => $group,
            'userFriends' => $userFriends,
            'userHeart' => $userHeart,
            'photo' => $photo,
            'metro' => $metro,
            'service' => $service,
            'postPrice' => $postPrice,
            'userPresent' => $userPresent,
            'userPhoto' => $userPhoto,
            'rayon' => $rayon,
        ]
    ) ?>

</div>

<?php if (Yii::$app->user->isGuest) {

    $ava = false;

     if (!empty($photo)) {

         foreach ($photo as $item){

             if ($item['avatar'] == 1){

                 $ava = $item['file'];

             }

         }

     }

    echo \frontend\widgets\InvitationWidget::widget([
            'img'       => $ava,
            'name'      => $model['username'],
            'post_id'      => $model['id'],
            'message'   => 'Привет'
    ]);

} ?>
