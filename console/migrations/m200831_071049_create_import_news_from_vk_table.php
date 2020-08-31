<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%import_news_from_vk}}`.
 */
class m200831_071049_create_import_news_from_vk_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%import_news_from_vk}}', [
            'id' => $this->primaryKey(),
            'group_url' => $this->string(60)->comment('урл группы с которой была взята новость'),
            'time' => $this->integer()->unsigned()->comment('метка времени ноаости из группы вк')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%import_news_from_vk}}');
    }
}
