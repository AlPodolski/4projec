<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promo_register_count}}`.
 */
class m210505_130419_create_promo_register_count_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promo_register_count}}', [
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
        $this->dropTable('{{%promo_register_count}}');
    }
}
