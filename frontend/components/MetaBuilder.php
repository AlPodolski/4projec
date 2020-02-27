<?php


namespace frontend\components;

use backend\models\MetaTemplate;
use common\models\FilterParams;
use Yii;
use yii\helpers\ArrayHelper;

class MetaBuilder
{
    /**
     * @param $uri
     * @param $city
     * @param $find
     * @return string
     */
    public static function Build($uri, $city, $find){

        $tamplate = self::getTemplate($find, $uri);

        $subject = '';

        if (!empty($tamplate)){

            $subject = $tamplate[$find];

            $pattern = '#:[a-z-A-Z-0-9]+#';

            if (preg_match_all($pattern, $subject, $marches )){

                foreach ($marches[0] as $param){

                    $subject = MetaBuilder::replaceParam($subject, $param,$uri, $city);

                }

            }

        }

         $subject = explode(',', $subject);

         $result = array();

         foreach ($subject as $value){

             $meta_subject = trim(preg_replace( '#\[(.+)\]#', '', $value));

            if ($meta_subject != '') $result[] = $meta_subject;

         }

         return StringHelper::str_replace_once(',', ' ', implode(',', $result));

    }

    /**
     * @param $find
     * @param $uri
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function getTemplate($find, $uri){

        if ($tamplate = MetaTemplate::find()->select($find)->where(['url' => $uri])->asArray()->one()) return $tamplate;

        else{

            $uri = self::prepareTemplate($uri);

            if ($uri and $tamplate = MetaTemplate::find()->select($find)->where(['url' => $uri])->asArray()->one()) return
                $tamplate;

            else return MetaTemplate::find()->select($find)->where(['url' => 'default'])->asArray()->one();

        }

    }

    /**
     * @param $string
     * @param $param
     * @param $uri
     * @param $city
     * @return mixed|string|string[]|null
     */
    public static function replaceParam($string, $param, $uri, $city){

        $uri = explode('/',$uri);

        foreach ($uri as $uriItem) {

            $className = preg_replace('#[0-9]+#', '', $param_name = trim($param, ':'));

            if ($class = ArrayHelper::getValue(FilterParams::find()->where(['url' => $className])->asArray()->one(), 'class_name')){

                $class = $class::find();

                if ($className == 'city'){

                    $result = $class->select($param_name)->where(['url' => $city])->asArray()->one();

                    $string = str_replace($param, $result[$param_name], $string);

                } else {

                    $url = self::replaceParamsFromUrl(str_replace($className.'-', '', $uriItem));

                    if ($url){

                        $result = $class->select('value')->where(['url' => $url])->asArray()->one();

                        if ($result) $string = self::replacePlaceholders($param, $result['value'], $string);

                    }


                }

            }

        }

        return $string;

    }

    /**
     * @param $param
     * @param $value
     * @param $string
     * @return mixed|string|string[]|null
     */
    public static function replacePlaceholders($param, $value, $string){

        $result = str_replace($param, $value, $string);

        $pattern = "#\[[^:a-z-A-Z]+\]#";

        if (preg_match($pattern,$result,$m)){

            $m[0] = str_replace('[', '', $m[0]);
            $m[0] = str_replace(']', '', $m[0]);

            $result = preg_replace($pattern, $m[0].', ['.$param.'] ', $result);

        }

        return $result;

    }

    /**
     * @param $tamplate
     * @return string
     */
    public static function prepareTemplate($tamplate){

        $result = array();

        $tamplate = explode('/', $tamplate);

        foreach ($tamplate as $item){

            $result[] = self::prepareUrl($item);

        }

        return trim(implode('/', $result), '/');

    }

    /**
     * @param $string
     * @return string
     */
    public static function prepareUrl($string){

        return trim(strstr($string, '-', true), '/');

    }

    /**
     * @param $url
     * @return string
     */
    public static function replaceParamsFromUrl($url){

        $params = Yii::$app->params['replaceParams'];

        return trim(str_replace($params, '', $url), '-');

    }

}