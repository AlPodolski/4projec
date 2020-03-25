<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wall}}`.
 */
class m200325_114116_create_wall_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wall}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment('ид пользователя на чьей стене запись'),
            'from' => $this->integer()->comment('кто автор записи'),
            'created_at' => $this->integer()->comment('время создания'),
            'text' => $this->text()->comment("текст записи"),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wall}}');
    }
}
