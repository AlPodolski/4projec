<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_financial_situation}}`.
 */
class m200219_121529_create_user_financial_situation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_financial_situation}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_financial_situation}}');
    }
}
