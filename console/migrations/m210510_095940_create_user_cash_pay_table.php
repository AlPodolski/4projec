<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_cash_pay}}`.
 */
class m210510_095940_create_user_cash_pay_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_cash_pay}}', [
            'id' => $this->primaryKey(),
            'date' => $this->string(24),
            'count' => $this->smallInteger()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_cash_pay}}');
    }
}
