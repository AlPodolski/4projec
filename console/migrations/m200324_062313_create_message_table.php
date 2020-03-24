<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m200324_062313_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'chat_id' => $this->integer()->unsigned(),
            'from' => $this->integer()->unsigned(),
            'message' => $this->text(),
            'created_at' => $this->integer()->unsigned(),
            'status' => $this->smallInteger()->comment('Отражает состояние сообщения, прочитано или нет'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}
