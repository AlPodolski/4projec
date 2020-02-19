<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_zhigalo}}`.
 */
class m200219_134954_create_user_zhigalo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_zhigalo}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_zhigalo}}');
    }
}
