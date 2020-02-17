<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_to_metro}}`.
 */
class m200217_090510_create_user_to_metro_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_to_metro}}', [
            'user_id' => $this->integer(),
            'metro_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_to_metro}}');
    }
}
