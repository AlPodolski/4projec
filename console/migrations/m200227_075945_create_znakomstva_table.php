<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%znakomstva}}`.
 */
class m200227_075945_create_znakomstva_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_znakomstva}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_znakomstva}}');
    }
}
