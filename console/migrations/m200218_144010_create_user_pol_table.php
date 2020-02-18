<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_pol}}`.
 */
class m200218_144010_create_user_pol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_pol}}', [
            'user_id' => $this->integer(),
            'pol_id' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_pol}}');
    }
}
