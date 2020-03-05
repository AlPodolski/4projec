<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_price}}`.
 */
class m200305_122117_add_city_id_column_to_user_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_price', 'city_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_price', 'city_id');
    }
}
