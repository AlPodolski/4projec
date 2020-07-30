<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_item}}`.
 */
class m200728_074420_create_group_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_item}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(),
            'author_id' => $this->integer(),
            'text' => $this->text(),
            'created_at' => $this->integer(),
        ]);

        $this->addForeignKey('fk-group_item_id-group-id', 'group_item', 'group_id', 'group', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group_item}}');
    }
}
