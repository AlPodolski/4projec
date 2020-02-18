<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_sexual}}`.
 */
class m200218_114632_create_user_sexual_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_sexual}}', [
            'user_id' => $this->integer(),
            'sexual_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_sexual}}');
    }
}
