<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_professionals}}`.
 */
class m200225_091421_create_user_professionals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_professionals}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_professionals}}');
    }
}
