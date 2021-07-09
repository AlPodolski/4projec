<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%count_message}}`.
 */
class m210709_104941_create_count_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%count_message}}', [
            'id' => $this->primaryKey(),
            'user_name' => $this->string(),
            'date' => $this->string(),
            'count' => $this->smallInteger()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%count_message}}');
    }
}
