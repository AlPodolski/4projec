<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_celi_znakomstvamstva}}`.
 */
class m200225_142751_create_user_celi_znakomstvamstva_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_celi_znakomstvamstva}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_celi_znakomstvamstva}}');
    }
}
