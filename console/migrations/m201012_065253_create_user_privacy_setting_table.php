<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_privacy_setting}}`.
 */
class m201012_065253_create_user_privacy_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_privacy_setting}}', [
            'user_id' => $this->integer(),
            'param'   => $this->smallInteger()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_privacy_setting}}');
    }
}
