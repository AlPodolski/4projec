<?php

use yii\widgets\ActiveForm;

/* @var $commentForm \frontend\models\forms\AddCommentForm */
/* @var $classRelatedModel string */
/* @var $classCss string */
/* @var $idCss string */
/* @var $relatedId integer */

$form = ActiveForm::begin([
    'action' => '#',
    'id' => $idCss,
    'options' => ['class' => $classCss],
]) ?>
<?= $form->field($commentForm, 'related_id',['options' => ['class' => 'd-none']])->hiddenInput(['value' => $relatedId ])->label(false) ?>
<?= $form->field($commentForm, 'text' , ['options' => ['class' => 'form-otvet']])->textarea(['placeholder' => 'Напишите что то'])->label(false) ?>
<?= $form->field($commentForm, 'class' , ['options' => ['class' => 'form-otvet']])->hiddenInput(['value' => $classRelatedModel])->label(false) ?>
    <span class="send-comment-btn" onclick="send_comment(this)" data-id="<?php echo $relatedId; ?>">
        Отправить
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0L20 10L0 20V0ZM0 8V12L10 10L0 8Z" fill="#486BEF" fill-opacity="0.13"/>
        </svg>
    </span>

<?php ActiveForm::end() ?>