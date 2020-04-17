<?php


namespace frontend\widgets;

use backend\models\MetaTemplate;
use common\models\Breast;
use common\models\City;
use common\models\FinancialSituation;
use common\models\HairColor;
use common\models\IntimHair;
use common\models\Pol;
use yii\base\Widget;
use common\models\Age;
use common\models\BodyType;
use common\models\National;
use common\models\Place;
use common\models\Price;
use common\models\Service;
use Yii;
use common\models\Metro;
use common\models\Rayon;
use \common\models\Interesting;
use \common\models\Children;
use common\models\Family;
use common\models\CeliZnakomstvamstva;
use common\models\Smoking;
use common\models\Alcogol;
use frontend\components\helpers\AvailableHelper;
use yii\helpers\ArrayHelper;

class SidebarWidget extends Widget
{

    private function getAvalibleIds(){

        if (isset (Yii::$app->params['result_id'])) return Yii::$app->params['result_id'];
        return false;

    }

    private function prepareHash($ids){
        if ($ids) return \md5(\implode(' ', $ids));
        return '_';
    }

    public function run()
    {

        $param = 'znakomstva/';

        $url = Yii::$app->request->url;

        $hash = $this->prepareHash($this->getAvalibleIds());

        $html = Yii::$app->cache->get('4dosug_sidebar'.$hash);

        if ($html === false) {
            // $data нет в кэше, вычисляем заново
            $city_id = ArrayHelper::getValue(City::find()->select('id')->where(['url' => Yii::$app->controller->actionParams['city']])->one(), 'id');

            //objee
            $metroList = AvailableHelper::getAvailable(Metro::class, $this->getAvalibleIds(), $city_id, true);
            $rayonList = AvailableHelper::getAvailable(Rayon::class, $this->getAvalibleIds(), $city_id, true);

            $polList = AvailableHelper::getAvailable(Pol::class, $this->getAvalibleIds(),  $city_id);
            $serviceList = AvailableHelper::getAvailable(Service::class, $this->getAvalibleIds(),  $city_id);
            $ageList = AvailableHelper::getAvailable(Age::class, $this->getAvalibleIds(),  $city_id);
            $nationalList = AvailableHelper::getAvailable(National::class, $this->getAvalibleIds(),  $city_id);
            $bodyList = AvailableHelper::getAvailable(BodyType::class, $this->getAvalibleIds(),  $city_id);
            $smoke = AvailableHelper::getAvailable(Smoking::class, $this->getAvalibleIds(),  $city_id);
            $alcogol = AvailableHelper::getAvailable(Alcogol::class, $this->getAvalibleIds(),  $city_id);
            $hairColorList = AvailableHelper::getAvailable(HairColor::class, $this->getAvalibleIds(),  $city_id);
            $intimHairList = AvailableHelper::getAvailable(IntimHair::class, $this->getAvalibleIds(),  $city_id);

            if (\strstr($param, 'znakomstva')){
                //znakom
                $interesi = AvailableHelper::getAvailable(Interesting::class, $this->getAvalibleIds(),  $city_id);
                $deti = AvailableHelper::getAvailable(Children::class, $this->getAvalibleIds(),  $city_id);
                $semeinoePolojenie = AvailableHelper::getAvailable(Family::class, $this->getAvalibleIds(),  $city_id);
                $celiZnakomstva = AvailableHelper::getAvailable(CeliZnakomstvamstva::class, $this->getAvalibleIds(),  $city_id);
                $materialnoePolojenie = AvailableHelper::getAvailable(FinancialSituation::class, $this->getAvalibleIds(),  $city_id);
            }else{
                //pr
                $priceList = AvailableHelper::getAvailable(Price::class, $this->getAvalibleIds(),  $city_id);
            }

            if (isset(Yii::$app->controller->actionParams['param'])) $param =
                $this->prepereParam(Yii::$app->controller->actionParams['param']);

            $html =  $this->render('sidebar', [
                'ageList' => $ageList,
                'nationalList' => $nationalList,
                'bodyList' => $bodyList,
                'serviceList' => $serviceList,
                'metroList' => $metroList,
                'rayonList' => $rayonList,
                'interesi' => $interesi,
                'deti' => $deti,
                'semeinoePolojenie' => $semeinoePolojenie,
                'celiZnakomstva' => $celiZnakomstva,
                'smoke' => $smoke,
                'alcogol' => $alcogol,
                'hairColorList' => $hairColorList,
                'polList' => $polList,
                'intimHairList' => $intimHairList,
                'materialnoePolojenie' => $materialnoePolojenie,
                'param' => $param,
            ]);
            // Сохраняем значение $data в кэше. Данные можно получить в следующий раз.
            Yii::$app->cache->set('4dosug_sidebar'.$hash, $html, 24 * 3600);
        }

        return $html;


    }

    private function prepereParam($param){

        return explode('/',$param);

    }

    public function init()
    {
        parent::run(); // TODO: Change the autogenerated stub
    }

}