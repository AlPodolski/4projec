<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sexual}}`.
 */
class m200218_112622_create_sexual_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sexual}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);

        $this->insert('sexual', ['value' => 'Гетеро', 'url' => 'getero']);
        $this->insert('sexual', ['value' => 'Гомо', 'url' => 'gomo']);
        $this->insert('sexual', ['value' => 'Би', 'url' => 'bi']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sexual}}');
    }
}
