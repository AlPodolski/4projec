<?php

use yii\db\Migration;

/**
 * Class m200422_110235_add_balans_table_to_user_table
 */
class m200422_110235_add_balans_table_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'cash', $this->smallInteger()->defaultValue(0) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'cash');
    }
}
