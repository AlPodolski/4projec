<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%intim_hair}}`.
 */
class m200228_133723_create_intim_hair_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%intim_hair}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%intim_hair}}');
    }
}
