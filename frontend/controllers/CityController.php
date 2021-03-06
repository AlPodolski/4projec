<?php


namespace frontend\controllers;

use common\models\City;
use Yii;
use yii\web\Controller;

class CityController extends Controller
{
    public function actionSearch($protocol, $domain){

        if(Yii::$app->request->isPost){

            $city = Yii::$app->request->post('city');

            if (mb_strlen($city) > 2 ) {

                $citys = City::find()->where(['like', 'city' , $city])->asArray()->all();

                if ($citys) return $this->renderFile('@app/views/city/city.php' ,[

                    'citys' => $citys,
                    'domain' => $domain,
                    'protocol' => $protocol,

                ]);

                echo 'Такого города нет';

            }

        }

        //return $this->goHome();

    }
}