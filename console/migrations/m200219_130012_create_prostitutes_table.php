<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prostitutes}}`.
 */
class m200219_130012_create_prostitutes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prostitutes}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);

        $this->insert('prostitutes', ['url' => 'prostitutki', 'value' => 'проститутки']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prostitutes}}');
    }
}
