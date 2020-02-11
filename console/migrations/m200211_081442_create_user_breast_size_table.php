<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_breast_size}}`.
 */
class m200211_081442_create_user_breast_size_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_breast_size}}', [
            'user_id' => $this->integer(),
            'value' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_breast_size}}');
    }
}
