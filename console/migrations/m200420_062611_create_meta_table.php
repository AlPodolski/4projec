<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meta}}`.
 */
class m200420_062611_create_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%meta}}', [
            'id' => $this->primaryKey(),
            'city' => $this->string(),
            'tag' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta}}');
    }
}
