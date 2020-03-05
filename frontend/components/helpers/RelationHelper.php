<?php


namespace frontend\components\helpers;
use backend\models\MetaTemplate;
use common\models\FilterParams;
use Yii;


class RelationHelper
{
    public static function gerClassRelation($className){

        $result = Yii::$app->cache->get('4dosug_relation_'.$className);

        if ($result === false) {
            // $data нет в кэше, вычисляем заново
            $result = FilterParams::find()->where(['class_name' => $className])->asArray()->one();
            // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
            Yii::$app->cache->set('4dosug_relation_'.$className , $result);
        }

        return $result;

    }
}