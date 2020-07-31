<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%user_group}}`.
 */
class m200731_074342_drop_user_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%user_group}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%user_group}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
