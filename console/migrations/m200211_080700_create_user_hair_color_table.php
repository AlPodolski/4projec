<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_hair_color}}`.
 */
class m200211_080700_create_user_hair_color_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_hair_color}}', [
            'user_id' => $this->integer(),
            'value' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_hair_color}}');
    }
}
