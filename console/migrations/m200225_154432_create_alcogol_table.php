<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%alcogol}}`.
 */
class m200225_154432_create_alcogol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%alcogol}}', [
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
        $this->dropTable('{{%alcogol}}');
    }
}
