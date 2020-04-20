<?php


namespace console\controllers;


use common\models\City;
use frontend\models\Meta;
use Yii;
use yii\console\Controller;

class WebmasterController extends Controller
{
    public function actionIndex()
    {

        $access_token = 'AgAAAAA9U_zpAAOcKijjk-Xma0QIps9Ej4ZNTXI';
        $host = Yii::$app->params['site_name'];

        $citys = City::find()->asArray()->all();

        foreach ($citys as $city){

            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Accept-language: en\r\n" .
                        "Cookie: foo=bar\r\n".
                        'Authorization: OAuth '.$access_token,

                )
            );

            $context = stream_context_create($opts);

            $user_id = file_get_contents("https://api.webmaster.yandex.net/v3/user/", false, $context);
            $user_id = json_decode($user_id);
            $user_id = $user_id->user_id;



            $content = '
                
                <Data>
                    <host_url>https://'.$city['url'].'.'.$host.'</host_url>
                </Data>
                
                ';



            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.webmaster.yandex.net/v4/user/{$user_id}/hosts/");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$content);  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'Content-type: application/xml',
                'Authorization: OAuth '.$access_token
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = curl_exec ($ch);

            curl_close ($ch);

            $result=json_decode($server_output);


            $content = '';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://api.webmaster.yandex.net/v3/user/{$user_id}/hosts/".urlencode($result->host_id)."/verification/?verification_type=META_TAG");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$content);  //Post Fields
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'Content-type: application/xml',
                'Authorization: OAuth '.$access_token
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $server_output = curl_exec ($ch);

            curl_close ($ch);

            $server_output = json_decode($server_output);

            $meta2 =  $server_output->verification_uin;

            $meta_model = new Meta();

            $meta_model->city = $city['url'];
            $meta_model->tag = $meta2;

            $meta_model->save();

            return true;

        }
    }
}