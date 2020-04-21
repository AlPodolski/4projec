<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 */
class m200421_063544_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(255),
            'mail' => $this->string(255),
            'status' => $this->tinyInteger(),
            'created_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
