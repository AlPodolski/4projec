<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_vneshnost}}`.
 */
class m200225_092609_create_user_vneshnost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_vneshnost}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_vneshnost}}');
    }
}
