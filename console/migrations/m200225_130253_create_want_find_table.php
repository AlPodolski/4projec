<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%want_find}}`.
 */
class m200225_130253_create_want_find_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%want_find}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
            'pol' => $this->smallInteger(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%want_find}}');
    }
}
