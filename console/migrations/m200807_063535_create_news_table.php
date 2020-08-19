<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m200807_063535_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'user_id' => $this->integer()->unsigned()->comment('ид пользователя для которого новость'),
            'related_class' => $this->string(122)->comment('связанный класс'),
            'news_id' => $this->integer()->unsigned()->comment('ид новости'),
            'timestamp' => $this->integer()->unsigned()->comment('Время добавления'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
