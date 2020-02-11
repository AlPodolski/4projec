<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%body_type}}`.
 */
class m200211_070222_create_body_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%body_type}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
        ]);

        $this->insert('body_type', ['value' => 'обычное']);
        $this->insert('body_type', ['value' => 'худощавое']);
        $this->insert('body_type', ['value' => 'стройное']);
        $this->insert('body_type', ['value' => 'спортивное']);
        $this->insert('body_type', ['value' => 'мускулистое']);
        $this->insert('body_type', ['value' => 'плотное']);
        $this->insert('body_type', ['value' => 'очень полное']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%body_type}}');
    }
}
