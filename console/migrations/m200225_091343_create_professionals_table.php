<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%professionals}}`.
 */
class m200225_091343_create_professionals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%professionals}}', [
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
        $this->dropTable('{{%professionals}}');
    }
}
