<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page_marck}}`.
 */
class m200930_101102_create_page_marck_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page_mark}}', [
            'id' => $this->primaryKey(),
            'page_url' => $this->string(122)->comment('Адресс страницы'),
            'text' => $this->string(122)->comment('Текст'),
            'url' => $this->string(122)->comment('Ссылка'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%page_marck}}');
    }
}
