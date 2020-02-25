<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vneshnost}}`.
 */
class m200225_092535_create_vneshnost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vneshnost}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vneshnost}}');
    }
}
