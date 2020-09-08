<?php


namespace frontend\models\forms;

use frontend\models\UserHeart;
use yii\base\Model;

class GetHeartForm extends Model
{

    public $who_id; //кто занял сердце
    public $whom_id; //чье сердце занято

    public function rules()
    {
        return [
            [['who_id', 'whom_id'], 'integer']
        ];
    }

    public function save()
    {
        $model = new UserHeart();

        $model->who = $this->who_id;
        $model->whom = $this->whom_id;
        $model->timestamp = \time();

        $model->save();

    }

}