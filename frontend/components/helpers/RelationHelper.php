<?php


namespace frontend\components\helpers;
use common\models\FilterParams;


class RelationHelper
{
    public static function gerClassRelation($className){

        return FilterParams::find()->where(['class_name' => $className])->asArray()->one();

    }
}