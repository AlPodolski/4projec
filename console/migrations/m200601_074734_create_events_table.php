<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m200601_074734_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'timestamp' => $this->integer()->unsigned(),
            'from' => $this->integer(),
            'type' => $this->smallInteger()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
