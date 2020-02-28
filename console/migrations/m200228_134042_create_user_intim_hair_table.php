<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_intim_hair}}`.
 */
class m200228_134042_create_user_intim_hair_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_intim_hair}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_intim_hair}}');
    }
}
