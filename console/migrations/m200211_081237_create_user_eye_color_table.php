<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_eye_color}}`.
 */
class m200211_081237_create_user_eye_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_eye_color}}', [
            'user_id' => $this->integer(),
            'value' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_eye_color}}');
    }
}
