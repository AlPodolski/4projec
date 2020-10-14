<?php

/* @var $this yii\web\View */
/* @var $photo Photo */
use frontend\modules\user\models\Photo;
use frontend\widgets\UserSideBarWidget;
use yii\widgets\ActiveForm;

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

                        <div class="img-label-wrap ">

                            <?php

                                $photoModel = new Photo();

                                $form = ActiveForm::begin(['action' => '/user/photo/add', 'options' => ['enctype' => 'multipart/form-data', 'id' => 'add-gallery-form']]);

                            ?>

                                <label for="photo-file" class="">

                                    <span class="blue-btn "> Загрузить фото </span>

                                    <?= $form->field($photoModel, 'file[]')
                                                ->fileInput(['multiple' => true, 'accept' => 'image/*'])
                                                ->label(false) ?>

                                </label>

                        </div>

                    <div class="img-label-wrap d-none">
                        <span class="blue-btn " data-toggle="modal" data-target="#modal-add-albom"> Создать альбом </span>
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

<div class="modal fade" id="modal-add-albom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="present-modal-content-wrap">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Создать альбом</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.25 15.75L15.75 2.25" stroke="black" stroke-width="2"/>
                                <path d="M2.25 2.25L15.75 15.75" stroke="black" stroke-width="2"/>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>
