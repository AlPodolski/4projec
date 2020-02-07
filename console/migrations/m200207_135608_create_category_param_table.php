<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_param}}`.
 */
class m200207_135608_create_category_param_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_param}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_param}}');
    }
}
