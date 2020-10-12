<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%privacy_settings}}`.
 */
class m201009_065410_create_privacy_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%privacy_settings}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(60),
            'value' => $this->string(60),
        ]);

        $this->execute('INSERT INTO `privacy_settings` (`name` , `value`) VALUES ("Друзья" , "friends") , ("VIP пользователи" , "vip")');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%privacy_settings}}');
    }
}
