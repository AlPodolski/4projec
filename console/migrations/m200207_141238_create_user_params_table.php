<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_params}}`.
 */
class m200207_141238_create_user_params_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_params}}', [
            'param_id' => $this->integer(),
            'user_id' => $this->integer(),
            'value' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_params}}');
    }
}
