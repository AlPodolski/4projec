<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_dialog}}`.
 */
class m200324_063447_create_user_dialog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_dialog}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'dialog_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_dialog}}');
    }
}
