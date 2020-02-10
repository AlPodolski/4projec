<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_price}}`.
 */
class m200210_085504_create_user_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_price}}', [
            'price_id' => $this->integer(),
            'user_id' => $this->integer(),
            'value' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_price}}');
    }
}
