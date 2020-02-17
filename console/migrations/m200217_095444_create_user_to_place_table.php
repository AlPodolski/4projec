<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_to_place}}`.
 */
class m200217_095444_create_user_to_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_to_place}}', [
            'user_id' => $this->integer(),
            'place_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_to_place}}');
    }
}
