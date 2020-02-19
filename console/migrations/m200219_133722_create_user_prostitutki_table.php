<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_prostitutki}}`.
 */
class m200219_133722_create_user_prostitutki_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_prostitutki}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_prostitutki}}');
    }
}
