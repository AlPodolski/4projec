<?php

use yii\db\Migration;

/**
 * Class m210412_085532_add_order_info_and_user_to_column_obmenka_order_table
 */
class m210412_085532_add_order_info_and_user_to_column_obmenka_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('obmenka_order', 'user_to', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('obmenka_order', 'user_to');
    }

}
