<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%group_item}}`.
 */
class m200730_100729_drop_group_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%group_item}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%group_item}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
