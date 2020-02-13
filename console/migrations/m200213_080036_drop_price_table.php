<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%price}}`.
 */
class m200213_080036_drop_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%price}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
