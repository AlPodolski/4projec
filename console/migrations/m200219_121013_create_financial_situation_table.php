<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%financial_situation}}`.
 */
class m200219_121013_create_financial_situation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%financial_situation}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(50),
            'value' => $this->string(50),
        ]);

        $this->insert('financial_situation', ['value' => 'ищу спонсора', 'url' => 'ishchu-sponsora']);
        $this->insert('financial_situation', ['value' => 'готов стать спонсором', 'url' => 'gotov-stat-sponsorom']);
        $this->insert('financial_situation', ['value' => 'не нуждаюсь в спонсоре', 'url' => 'ne-nuzhdayus-v-sponsore']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%financial_situation}}');
    }
}
