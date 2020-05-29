<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sympathy_settings}}`.
 */
class m200529_063627_add_city_id_column_to_sympathy_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sympathy_setting', 'city_id', $this->smallInteger()->unsigned()->comment('id города'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('sympathy_setting', 'city_id');
    }
}
