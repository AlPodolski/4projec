<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vajnoe_v_partnere}}`.
 */
class m200225_114156_create_vajnoe_v_partnere_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vajnoe_v_partnere}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(50),
            'url' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vajnoe_v_partnere}}');
    }
}
