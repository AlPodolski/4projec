<?php

use yii\db\Migration;

/**
 * Class m200427_061545_alter_user_table
 */
class m200427_061545_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'email', $this->string(122)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'email', $this->string(122));
    }

}
