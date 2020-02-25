<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%intesting}}`.
 */
class m200225_075743_create_intesting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%interesting}}', [
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
        $this->dropTable('{{%interesting}}');
    }
}
