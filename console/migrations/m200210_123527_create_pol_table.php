<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pol}}`.
 */
class m200210_123527_create_pol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pol}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(40),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pol}}');
    }
}
