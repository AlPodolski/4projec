<?php


namespace frontend\models\forms;

use common\models\ObmenkaCurrency;
use common\models\ObmenkaOrder;
use frontend\components\service\obmenka\Obmenka;
use yii\base\Model;

class ObmenkaPayForm extends Model
{

    public $user_id;
    public $sum;
    public $currency;
    public $city;
    public $userToId;
    public $pay_info;

    public function rules()
    {
        return [
            [['user_id', 'sum', 'currency'], 'required'],
            [['user_id', 'sum', 'userToId', 'pay_info'], 'integer'],
            [['city'], 'string'],
            [['currency'] , 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'sum' => 'Сумма',
            'created_at' => 'Created At',
            'currency' => 'Выбрать способ оплаты',
            'status' => 'Status',
            'pay_info' => 'Status',
        ];
    }

    public function createPay()
    {

        if ($order = $this->createOrder() and $currency = ObmenkaCurrency::findOne($this->currency)){

            $obmenka = new Obmenka();

            if ($payUrl = $obmenka->getPayUrl($order->id, $order->sum, $this->city, $currency['value'])){

                return $payUrl;

            }

        }

        return false;

    }

    private function createOrder(){

        $order = new ObmenkaOrder();

        $order->user_id = $this->user_id;
        $order->sum = $this->sum;
        $order->status = ObmenkaOrder::WAIT;
        $order->pay_info = $this->pay_info;

        if ($order->save()) return $order;

        return false;

    }
}