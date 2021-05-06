<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo_register}}`.
 */
class m210505_101352_create_promo_register_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promo_register}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promo_register}}');
    }
}
