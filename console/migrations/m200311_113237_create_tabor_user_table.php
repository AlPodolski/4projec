<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tabor_user}}`.
 */
class m200311_113237_create_tabor_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tabor_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'tabor_id' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tabor_user}}');
    }
}
