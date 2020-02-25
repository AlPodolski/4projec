<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_children}}`.
 */
class m200225_121225_create_user_children_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_children}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_children}}');
    }
}
