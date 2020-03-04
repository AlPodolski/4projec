<?php


namespace frontend\components\helpers;

use yii\helpers\ArrayHelper;

class AvailableHelper
{
    public static function getAvailable($class, $ids, $city = false){

        if ($classInfo = RelationHelper::gerClassRelation($class)){

            $available_ids = $classInfo['relation_class']::find();

            if ($ids) $available_ids->where(['in' , 'user_id', $ids]);

            $available_ids = $available_ids->distinct()->asArray()->all();

            if ($available_ids){

                foreach ($available_ids as $item){

                    $available_service_ids[] = ArrayHelper::getValue($item,$classInfo['column_param_name'] );

                }

                 $available_service = $classInfo['class_name']::find()->where(['in' , 'id' , \array_unique($available_service_ids)])->asArray();

                if ($city) $available_service->andWhere(['city' => $city]);

                return $available_service->all();

            }

        }

    }



}