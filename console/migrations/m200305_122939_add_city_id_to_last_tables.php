<?php

use yii\db\Migration;

/**
 * Class m200305_122939_add_city_id_to_last_tables
 */
class m200305_122939_add_city_id_to_last_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_znakomstva', 'city_id', $this->smallInteger());
        $this->addColumn('user_ves', 'city_id', $this->smallInteger());
        $this->addColumn('user_to_rayon', 'city_id', $this->smallInteger());
        $this->addColumn('user_to_metro', 'city_id', $this->smallInteger());
        $this->addColumn('user_rost', 'city_id', $this->smallInteger());
        $this->addColumn('user_eye_color', 'city_id', $this->smallInteger());
        $this->addColumn('user_education', 'city_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_znakomstva', 'city_id');
        $this->dropColumn('user_ves', 'city_id');
        $this->dropColumn('user_to_rayon', 'city_id');
        $this->dropColumn('user_to_metro', 'city_id');
        $this->dropColumn('user_rost', 'city_id');
        $this->dropColumn('user_eye_color', 'city_id');
        $this->dropColumn('user_education', 'city_id');
    }

}
