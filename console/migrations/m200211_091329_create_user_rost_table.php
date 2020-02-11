<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_rost}}`.
 */
class m200211_091329_create_user_rost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_rost}}', [
            'user_id' => $this->integer(),
            'value' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_rost}}');
    }
}
