<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%zhigalo}}`.
 */
class m200219_134747_create_zhigalo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%zhigalo}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);

        $this->insert('prostitutes', ['url' => 'zhigalo', 'value' => 'жигало']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%zhigalo}}');
    }
}
