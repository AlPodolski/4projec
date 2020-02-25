<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_intresting}}`.
 */
class m200225_080454_create_user_intresting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_interesting}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_interesting}}');
    }
}
