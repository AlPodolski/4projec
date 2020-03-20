<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_presents}}`.
 */
class m200320_064607_create_user_presents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_presents}}', [
            'id' => $this->primaryKey(),
            'from' => $this->integer()->comment('ид пользователя от которого подарок'),
            'to' => $this->integer()->comment('ид пользователя которому подарок'),
            'resent_id' => $this->integer()->comment('ид подарка'),
            'timestamp' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_presents}}');
    }
}
