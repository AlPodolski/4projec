<?php

namespace frontend\modules\user\components\helpers;

use common\models\City;
use common\models\FilterParams;
use frontend\components\MarcHelper;
use frontend\models\UserPrice;
use frontend\modules\user\models\Profile;
use yii\helpers\ArrayHelper;
use Yii;

class QueryParamsHelper
{
    public static function getParams($params,$city)
    {

        $city = City::find()->select('id')->where(['url' => $city])->asArray()->one();

        $params = explode('/', $params);

        $filter_params = FilterParams::find()->asArray()->all();

        $ids = array();

        $query_params = array();
        $bread_crumbs_params = array();

        $stem = 0;

        //Перебираем параметры
        foreach ($params as $value) {

            foreach ($filter_params as $filter_param){

                $result_id_array = array();

                if (strstr($value, $filter_param['url'])) {

                    $className = $filter_param['class_name'];
                    $classRelationName = $filter_param['relation_class'];

                    $url = self::prepareUrl($filter_param['url'],$value );

                    if ($url and $className) {

                        $id = $className::find()->where(['url' => $url])->asArray()->one();

                        if (isset($id['value'])){
                            $bread_crumbs_params[] = [
                                'url' => '/' . $value,
                                'label' => $id['value']
                            ];
                        }

                        if ($id and $classRelationName) {

                            if (!empty($ids)) {

                                $relationsIds = ArrayHelper::getColumn($classRelationName::find()
                                    ->where([$filter_param['column_param_name'] => $id['id']])
                                    ->andWhere(['city_id' => $city['id']])
                                    ->asArray()->all(), 'user_id');

                                $ids = array_intersect($ids, $relationsIds) ;

                            } else {

                                $ids = ArrayHelper::getColumn($classRelationName::find()
                                    ->where([$filter_param['column_param_name'] => $id['id']])
                                    ->andWhere(['city_id' => $city['id']])
                                    ->asArray()->all(), 'user_id');

                            }

                            if (empty($ids)) {
                                $ids[] = [
                                    '0' => 0
                                ];
                            }

                        }

                    }



                }

            }

        }

        if ($ids) {

            Yii::$app->params['result_id'] = $ids;

            $query_params[] = ['in', 'id', $ids];


        }

        MarcHelper::AddMarc($bread_crumbs_params);

        if (!empty($query_params)) {

            return $query_params;

            $posts = Profile::find();

            foreach ($query_params as $item) {

                $posts->andWhere($item);

            }

            $posts = $posts->limit(12)->all();

            return $posts;

        }
    }

    public static function prepareUrl($url, $value){

        if ($url == $value) return $url;

        return str_replace($url. '-', '', $value);


    }

}