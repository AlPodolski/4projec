<?php


namespace frontend\components\service\obmenka;

use Yii;
use yii\base\Exception;

class Obmenka
{

    private $secret;
    private $clientID;
    protected $orderId;

    private $create_pay_url = 'https://acquiring_api.obmenka.ua/api/einvoice/create';
    private $process_pay_url = 'https://acquiring_api.obmenka.ua/api/einvoice/process';
    private $status_pay_url = 'https://acquiring_api.obmenka.ua/api/einvoice/status';

    public function __construct()
    {
        if (!isset(Yii::$app->params['obmenka_clientID'])) throw new Exception('Нужно указать ид клиента');

        if (!isset(Yii::$app->params['obmenka_sercret'])) throw new Exception('Нужно указать секретный ключ');

        $this->clientID = Yii::$app->params['obmenka_clientID'];
        $this->secret = Yii::$app->params['obmenka_sercret'];

    }

    public function getPayUrl($orderId, $sum, $city, $currency, $des = 'Пополнение кабинета')
    {
        $rayRequestResult = \json_decode($this->createPay($orderId, $sum, $city,$currency, $des ));

        if (isset($rayRequestResult->tracking) and $createPayUrl = $this->createPayUrl(
            $rayRequestResult->tracking,
            $rayRequestResult->payment_id
            )){

            return \json_decode($createPayUrl);

        }

        return false;

    }

    public function getOrderInfo($order_id)
    {
        $data = [
            'payment_id' => $order_id,
        ];

        return \json_decode($this->sendData($data, $this->status_pay_url));

    }

    private function createPayUrl($tracking, $orderId){

        $data = [
            'traking' => $tracking,
            'payment_id' => $orderId
        ];

        return $this->sendData($data, $this->process_pay_url);

    }

    private function createPay($orderId, $sum, $city, $currency, $des)
    {

        $data = [
            'payment_id' => $orderId,
            "amount" => $sum,
            'currency' => $currency,
            "description" => $des,
            "success_url" => "https://".$city.".4dosug.com/pay/obmenka/".$orderId,
            "fail_url" => "https://".$city.".4dosug.com/pay",
            "status_url" => "https://".$city.".4dosug.com/user",
        ];

        return $this->sendData($data, $this->create_pay_url);

    }

    private function sendData(array $data , $url){

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,array('Content-Type: application/json',
            "DPAY_CLIENT: ". $this->clientID,
            "DPAY_SECURE: " . $this->createSign(\json_encode($data))
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, \json_encode($data));
        $out = curl_exec($curl);;
        curl_close($curl);

        return $out;

    }

    private function createSign($data){

        return base64_encode(md5($this->secret . base64_encode(sha1( $data, true)) . $this->secret, true));

    }

}