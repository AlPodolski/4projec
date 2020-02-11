<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_ves}}`.
 */
class m200211_091507_create_user_ves_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_ves}}', [
            'user_id' => $this->integer(),
            'value' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_ves}}');
    }
}
