<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_body}}`.
 */
class m200211_081405_create_user_body_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_body}}', [
            'user_id' => $this->integer(),
            'value' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_body}}');
    }
}
