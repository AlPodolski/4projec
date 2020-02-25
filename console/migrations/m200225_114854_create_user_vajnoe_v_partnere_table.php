<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_vajnoe_v_partnere}}`.
 */
class m200225_114854_create_user_vajnoe_v_partnere_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_vajnoe_v_partnere}}', [
            'user_id' => $this->integer(),
            'param_id' => $this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_vajnoe_v_partnere}}');
    }
}
