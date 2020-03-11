<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_transport}}`.
 */
class m200311_091841_create_user_transport_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_transport}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
            'city_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_transport}}');
    }
}
