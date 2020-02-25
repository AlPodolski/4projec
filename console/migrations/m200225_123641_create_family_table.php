<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%family}}`.
 */
class m200225_123641_create_family_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%family}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
            'pol' => $this->smallInteger()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%family}}');
    }
}
