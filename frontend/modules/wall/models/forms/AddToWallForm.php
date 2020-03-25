<?php


namespace frontend\modules\wall\models\forms;

use frontend\modules\wall\models\Wall;
use yii\base\Model;

/**
 * This is the model class for table "wall".
 *
 * @property int|null $user_id ид пользователя на чьей стене запись
 * @property int|null $from кто автор записи
 * @property int|null $created_at время создания
 * @property string|null $text текст записи
 */
class AddToWallForm extends Model
{
    public $user_id;
    public $text;
    public $from;
    public $created_at;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'from', 'created_at'], 'integer'],
            [['user_id', 'from', 'created_at', 'text'], 'required'],
            [['text'], 'string', 'max' => 600],
        ];
    }

    public function save(){

        $wallItem = new Wall();

        $wallItem->user_id = $this->user_id;
        $wallItem->from = $this->from;
        $wallItem->created_at = $this->created_at;
        $wallItem->text = $this->text;

        return $wallItem->save();

    }
}