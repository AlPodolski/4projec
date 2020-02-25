<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%haracter}}`.
 */
class m200225_143539_create_haracter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%haracter}}', [
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
        $this->dropTable('{{%haracter}}');
    }
}
