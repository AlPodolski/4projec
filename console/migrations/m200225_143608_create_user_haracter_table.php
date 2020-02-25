<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_haracter}}`.
 */
class m200225_143608_create_user_haracter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_haracter}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_haracter}}');
    }
}
