<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%present_to_category}}`.
 */
class m200319_130408_create_present_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%present_to_category}}', [
            'present_id' => $this->smallInteger(),
            'category_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%present_to_category}}');
    }
}
