<?php
/* @var $cityInfo array*/
namespace frontend\components;

use frontend\modules\user\models\Profile;

class SingleMetaHelper
{
    public static function Title($model, $cityInfo)
    {
        /* @var $model Profile */

        $title = $model->username .' из города '.$cityInfo['city'];

        if (!empty($model['sexual'])) {
            $title .= ' ориентация ';
            foreach ($model['sexual'] as $item) $title .=' '. $item['value'] . ' ' ;
        }

        if (!empty($model['wantFind'])){
            $title .= ' хочу найти ';
            foreach ($model['wantFind'] as $item) $title .=' '. $item['value'] . ' ' ;
        }

        return $title;
    }
    public static function Description($model)
    {
        /* @var $model Profile */

        $result = '';

        if (!empty($model->text)) {
            $result = $model->text;
        }else {
            if (!empty($model['bodyType'])){
                $result .= ' Телосложение ';
                foreach ($model['bodyType'] as $item) $result .=' '. $item['value'] . ' ' ;
            }
            if (!empty($model['interesting'])){
                $result .= ' мои интересы ';
                foreach ($model['interesting'] as $item) $result .=' '. $item['value'] . ' ' ;
            }
            if (!empty($model['vajnoeVPartnere'])){
                $result .= ' важно в партнере ';
                foreach ($model['vajnoeVPartnere'] as $item) $result .=' '. $item['value'] . ' ' ;
            }

        }

        if ($result == '') $result = ' Мое имя '.$model->username. ' я жду новых интересных знакомств с приятными людьми';

        return $result;
    }
}