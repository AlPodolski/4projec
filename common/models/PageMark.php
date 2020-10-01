<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_mark".
 *
 * @property int $id
 * @property string|null $page_url Адресс страницы
 * @property string|null $text Текст
 * @property string|null $url Ссылка
 */
class PageMark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_mark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_url', 'text', 'url'], 'string', 'max' => 122],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_url' => 'Адресс страницы',
            'text' => 'Текст',
            'url' => 'Ссылка',
        ];
    }
}
