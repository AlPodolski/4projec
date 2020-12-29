<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%black_list}}`.
 */
class m201229_081947_create_black_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%black_list}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%black_list}}');
    }
}
