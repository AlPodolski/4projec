<?php

namespace frontend\modules\user\components\helpers;

use frontend\modules\user\models\Photo;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageHelper
{
    public static function regenerateImg($img, $width , $save_path){

        return Image::resize ($img, $width, 9999)->save($save_path, ['quality' => 80]);

    }

    public static function prepareImage(UploadedFile $file, Photo $photo, $save_dir, $file_name,  $max_with = 1024){

        $size = \getimagesize($file->tempName);

        if ($size[0] > $max_with) $result = ImageHelper::regenerateImg($file->tempName, $max_with, $save_dir.$file_name );
        else $result = ImageHelper::regenerateImg($file->tempName, $size[0], $save_dir.$file_name );

        return $result;

    }

}