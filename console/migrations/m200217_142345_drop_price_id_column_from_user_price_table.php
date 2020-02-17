<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%user_price}}`.
 */
class m200217_142345_drop_price_id_column_from_user_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user_price', 'price_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user_price', 'price_id', $this->integer() );
    }
}
