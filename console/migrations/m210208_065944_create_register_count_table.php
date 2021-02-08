<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%register_count}}`.
 */
class m210208_065944_create_register_count_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%register_count}}', [
            'id' => $this->primaryKey(),
            'date' => $this->string(24),
            'count' => $this->smallInteger()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%register_count}}');
    }
}
