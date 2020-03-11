<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_zhile}}`.
 */
class m200311_082127_create_user_zhile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_zhile}}', [
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
        $this->dropTable('{{%user_zhile}}');
    }
}
