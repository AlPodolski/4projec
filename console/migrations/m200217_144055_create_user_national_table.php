<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_national}}`.
 */
class m200217_144055_create_user_national_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_national}}', [
            'user_id' => $this->integer(),
            'national_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_national}}');
    }
}
