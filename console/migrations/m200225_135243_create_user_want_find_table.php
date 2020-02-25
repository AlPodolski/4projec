<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_want_find}}`.
 */
class m200225_135243_create_user_want_find_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_want_find}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_want_find}}');
    }
}
