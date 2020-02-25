<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%life_goals}}`.
 */
class m200225_151219_create_life_goals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%life_goals}}', [
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
        $this->dropTable('{{%life_goals}}');
    }
}
