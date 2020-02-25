<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_smoking}}`.
 */
class m200225_152705_create_user_smoking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_smoking}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_smoking}}');
    }
}
