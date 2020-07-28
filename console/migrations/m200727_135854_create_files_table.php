<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m200727_135854_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
            'related_id' => $this->integer()->comment('связанный ид'),
            'related_class' => $this->string(122)->comment('связанный класс'),
            'file' => $this->string(122)->comment('путь к файлу'),
            'main' => $this->integer(1)->comment('является ли изображение главным 0 нет 1 да'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files}}');
    }
}
