<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presents}}`.
 */
class m200319_114208_create_presents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%presents}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'img' => $this->string(50),
            'status' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%presents}}');
    }
}
