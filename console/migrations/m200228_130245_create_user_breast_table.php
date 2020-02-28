<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_breast}}`.
 */
class m200228_130245_create_user_breast_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_breast}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_breast}}');
    }
}
