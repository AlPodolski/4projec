<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_prostitutes}}`.
 */
class m200304_135329_add_city_column_to_user_prostitutes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_prostitutki', 'city_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_prostitutki', 'city_id');
    }
}
