<?php

/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;


$this->registerJsFile('/files/js/cabinet.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Все фото';

?>
<div class="row">

    <div class="col-3">
        <?php echo UserSideBarWidget::Widget()?>
    </div>

    <div class="col-12 col-xl-9">

        <div class="page-block anket all-photo">

        <?php if (!empty($photo)) :  ?>

            <div class="row">

                <div class="col-12 d-flex flex-row-reverse">

                    <?php

                        $photoModel = new Photo();

                        $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data', 'id' => 'add-gallery-form']]);

                    ?>

                    <div class="img-label-wrap">

                        <label for="photo-file" class="">

                            <span class="blue-btn"> Загрузить фото </span>

                            <?= $form->field($photoModel, 'file[]')
                                        ->fileInput(['multiple' => true, 'accept' => 'image/*'])
                                        ->label(false) ?>

                            </label>

                        </div>

                <?php ActiveForm::end(); ?>

                </div>


                <div class="col-12">
                    <div class="row photo-items">

                        <?php foreach ($photo as $item) :  ?>

                            <div class="col-6 col-sm-3 col-lg-2">
                                <div class="item">
                                    <?php if (!Yii::$app->user->isGuest and Yii::$app->user->id == $item['user_id'] ) : ?>

                                        <span onclick="deletePhotoItem(this)" data-id="<?php echo $item['id']; ?>" class="wall-tem-menu"><i class="fas fa-times"></i></span>

                                    <?php endif; ?>
                                    <?php if (file_exists(Yii::getAlias('@webroot') . $item->file) and $item->file) : ?>

                                        <?= Yii::$app->imageCache->thumb($item->file, 'gallery-mini', ['class' => 'img']) ?>

                                    <?php endif; ?>
                                </div>

                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

        <?php else : ?>

        <p class="alert alert-info">Для того что бы удалить что то ненужное с начала нужно добавить что то ненужное</p>

        <?php endif;  ?>

    </div>

    </div>


</div>