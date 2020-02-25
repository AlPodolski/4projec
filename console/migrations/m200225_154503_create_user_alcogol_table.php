<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_alcogol}}`.
 */
class m200225_154503_create_user_alcogol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_alcogol}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_alcogol}}');
    }
}
