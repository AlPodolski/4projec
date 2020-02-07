<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_service}}`.
 */
class m200207_124428_create_user_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_service}}', [
            'user_id' => $this->integer(),
            'service_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_service}}');
    }
}
