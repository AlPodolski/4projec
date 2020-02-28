<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%breast}}`.
 */
class m200228_125709_create_breast_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%breast}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%breast}}');
    }
}
