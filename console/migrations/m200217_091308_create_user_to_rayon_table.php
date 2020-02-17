<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_to_rayon}}`.
 */
class m200217_091308_create_user_to_rayon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_to_rayon}}', [
            'user_id' => $this->integer(),
            'rayon_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_to_rayon}}');
    }
}
