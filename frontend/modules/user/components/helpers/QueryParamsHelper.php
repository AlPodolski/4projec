<?php

namespace frontend\modules\user\components\helpers;

use common\models\FilterParams;
use frontend\models\UserPrice;
use frontend\modules\user\models\Profile;
use yii\helpers\ArrayHelper;
use Yii;

class QueryParamsHelper
{
    public static function getParams($params)
    {

        $params = explode('/', $params);

        $filter_params = FilterParams::find()->asArray()->all();

        $ids = array();

        $query_params = array();
        $bread_crumbs_params = array();

        //Перебираем параметры
        foreach ($params as $value) {

            foreach ($filter_params as $filter_param){

                if (strstr($value, $filter_param['url'])) {

                    $className = $filter_param['class_name'];
                    $classRelationName = $filter_param['relation_class'];

                    $url = str_replace($filter_param['url'], '', \str_replace('-', '',$value));

                    if ($url) $id = $className::find()->where(['url' => $url])->asArray()->one();
                    //если не нашли то скорее всего это категория
                    else $id = $className::find()->where(['url' => $filter_param['url']])->asArray()->one();

                    if ($id and $classRelationName) {

                        $bread_crumbs_params[] = [
                            'url' => '/' . $value,
                            'label' => $id['value']
                        ];

                        if (!empty($ids)) {

                            $relationsIds = $classRelationName::find()->where([$filter_param['column_param_name'] => $id['id']])->asArray()->all();

                            foreach ($relationsIds as $item) {

                                foreach ($ids as $item2) {

                                    if ($item['user_id'] == $item2['user_id']) $result_id_array[] = $item2;

                                }

                            }

                            $ids = $result_id_array;

                        } else {

                            $ids = $classRelationName::find()->where([$filter_param['column_param_name'] => $id['id']])->asArray()->all();

                        }

                        if (empty($ids)) {
                            $ids[] = [
                                '0' => 0
                            ];
                        }

                    }

                }

            }


            if (strstr($value, 'vozrast')) {

                $url = str_replace('vozrast-', '', $value);

                $age_params = array();

                if ($url == 'ot-18-do-20-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 18];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 20];
                }

                if ($url == 'ot-21-do-25-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 21];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 25];
                }

                if ($url == 'ot-26-do-30-let') {
                    $age_params[] = ['<=', 'birthday', \time() - (24 * 3600 * 365 * 26)];
                    $age_params[] = ['>=', 'birthday', \time() - (24 * 3600 * 365 * 30)];
                }

                if ($url == 'ot-31-do-35-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 31];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 35];
                }

                if ($url == 'ot-36-do-40-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 36];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 40];
                }

                if ($url == 'ot-41-do-45-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 41];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 45];
                }

                if ($url == 'ot-46-do-50-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 46];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 50];
                }

                if ($url == 'ot-51-do-55-let') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 51];
                    $age_params[] = ['>=', 'birthday', \time() - 24 * 3600 * 365 * 55];
                }

                if ($url == 'starshe-55') {
                    $age_params[] = ['<=', 'birthday', \time() - 24 * 3600 * 365 * 55];
                }

                $id = Profile::find();

                foreach ($age_params as $age_param) {
                    $id->andWhere($age_param);
                }

                $id = $id->asArray()->all();


                if ($id) {

                    $result_id_array = array();

                    if (!empty($ids)) {

                        foreach ($id as $id_item) {

                            $result[] = ArrayHelper::getValue($id_item, 'id');

                        }

                        $ids2 = $id;

                        foreach ($ids2 as $item) {

                            foreach ($ids as $item2) {

                                if ($item['id'] == $item2['user_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    } else {

                        foreach ($id as $id_item) {

                            $result[] = ArrayHelper::getValue($id_item, 'id');

                        }

                        $ids = $id;

                    }

                }

            }

            if (strstr($value, 'cena')) {

                $url = str_replace('cena-', '', $value);

                $price_params = array();

                if ($url == 'do-1500') $price_params[] = ['<', 'value', 1500];

                if ($url == 'ot-1500-do-2000') {
                    $price_params[] = ['>=', 'value', 1500];
                    $price_params[] = ['<=', 'value', 1999];
                }
                if ($url == 'ot-2000-do-3000') {
                    $price_params[] = ['>=', 'value', 2000];
                    $price_params[] = ['<=', 'value', 2999];
                }
                if ($url == 'ot-3000-do-6000') {
                    $price_params[] = ['>=', 'value', 3000];
                    $price_params[] = ['<=', 'value', 6000];
                }

                if ($url == 'ot-6000') {
                    $price_params[] = ['>=', 'value', 6001];
                }


                $id = UserPrice::find();

                foreach ($price_params as $price_param) {
                    $id->andWhere($price_param);
                }

                $id = $id->asArray()->all();


                if ($id) {

                    $result_id_array = array();


                    if (!empty($ids)) {


                        foreach ($id as $id_item) {

                            $result[] = ArrayHelper::getValue($id_item, 'user_id');

                        }

                        $ids2 = UserPrice::find()->where(['in', 'user_id', $result])->asArray()->all();

                        foreach ($ids2 as $item) {

                            foreach ($ids as $item2) {

                                if ($item['user_id'] == $item2['user_id']) $result_id_array[] = $item2;

                            }

                        }

                        $ids = $result_id_array;

                    } else {

                        foreach ($id as $id_item) {

                            $result[] = ArrayHelper::getValue($id_item, 'user_id');

                        }

                        $ids = UserPrice::find()->where(['in', 'user_id', $result])->asArray()->all();

                    }

                }

            }

        }

        if ($ids) {

            foreach ($ids as $id) {

                $result[] = ArrayHelper::getValue($id, 'user_id');

                if (!empty($result)) Yii::$app->params['result_id'] = $result;

            }

            $query_params[] = ['in', 'id', $result];


        }

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
}