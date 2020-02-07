<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%params}}`.
 */
class m200207_134802_create_params_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%params}}', [
            'id' => $this->primaryKey(),
            'category_param_id' => $this->integer(),
            'param' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%params}}');
    }
}
