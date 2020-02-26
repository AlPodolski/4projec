<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_education}}`.
 */
class m200226_071929_create_user_education_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_education}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_education}}');
    }
}
