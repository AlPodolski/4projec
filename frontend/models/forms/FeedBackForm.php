<?php


namespace frontend\models\forms;

use yii\base\Model;
use common\models\Feedback;

class FeedBackForm extends Model
{
    public $text;
    public $mail;


    public function rules()
    {
        return [
            [['text', 'mail'], 'required'],
            [['mail'], 'email'],
            [['text'], 'string' , 'max' => 255, 'min' => 10],
            [['text'], 'filter' , 'filter'  => function ($value){
                return \htmlspecialchars($value);
            }],
        ];
    }

    public function save(){

        if ($this->validate()){
            $model = new Feedback();

            $model->text = $this->text;
            $model->mail = $this->mail;
            $model->created_at = \time();
            $model->status = Feedback::NOT_READ;

            return $model->save();
        }
    }

    public function attributeLabels()
    {
        return [
            'mail' => 'Ваша почта',
            'text' => 'Сообщение',
        ];
    }
}