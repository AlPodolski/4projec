<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_life_goals}}`.
 */
class m200225_151304_create_user_life_goals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_life_goals}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_life_goals}}');
    }
}
