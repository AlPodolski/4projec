<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presents_category}}`.
 */
class m200319_123843_create_presents_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%presents_category}}', [
            'id' => $this->primaryKey(),
            'category_name' => $this->string(50),
        ]);

        $this->insert('presents_category', ['category_name' => 'Актуальные']);
        $this->insert('presents_category', ['category_name' => 'Романтика']);
        $this->insert('presents_category', ['category_name' => 'День рождения']);
        $this->insert('presents_category', ['category_name' => 'Дружба']);
        $this->insert('presents_category', ['category_name' => 'Премиум']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%presents_category}}');
    }
}
