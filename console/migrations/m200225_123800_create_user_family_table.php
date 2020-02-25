<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_family}}`.
 */
class m200225_123800_create_user_family_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_family}}', [
            'param_id' => $this->smallInteger(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_family}}');
    }
}
