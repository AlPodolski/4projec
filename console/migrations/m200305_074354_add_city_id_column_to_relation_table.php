<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%relation}}`.
 */
class m200305_074354_add_city_id_column_to_relation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_to_place', 'city_id', $this->smallInteger());
        $this->addColumn('user_sexual', 'city_id', $this->smallInteger());
        $this->addColumn('user_body', 'city_id', $this->smallInteger());
        $this->addColumn('user_service', 'city_id', $this->smallInteger());
        $this->addColumn('user_national', 'city_id', $this->smallInteger());
        $this->addColumn('user_financial_situation', 'city_id', $this->smallInteger());
        $this->addColumn('user_zhigalo', 'city_id', $this->smallInteger());
        $this->addColumn('user_interesting', 'city_id', $this->smallInteger());
        $this->addColumn('user_professionals', 'city_id', $this->smallInteger());
        $this->addColumn('user_vneshnost', 'city_id', $this->smallInteger());
        $this->addColumn('user_vajnoe_v_partnere', 'city_id', $this->smallInteger());
        $this->addColumn('user_children', 'city_id', $this->smallInteger());
        $this->addColumn('user_family', 'city_id', $this->smallInteger());
        $this->addColumn('user_want_find', 'city_id', $this->smallInteger());
        $this->addColumn('user_celi_znakomstvamstva', 'city_id', $this->smallInteger());
        $this->addColumn('user_haracter', 'city_id', $this->smallInteger());
        $this->addColumn('user_life_goals', 'city_id', $this->smallInteger());
        $this->addColumn('user_smoking', 'city_id', $this->smallInteger());
        $this->addColumn('user_alcogol', 'city_id', $this->smallInteger());
        $this->addColumn('user_celi_znakomstvamstva', 'city_id', $this->smallInteger());
        $this->addColumn('user_breast_size', 'city_id', $this->smallInteger());
        $this->addColumn('user_intim_hair', 'city_id', $this->smallInteger());
        $this->addColumn('user_pol', 'city_id', $this->smallInteger());
        $this->addColumn('user_hair_color', 'city_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_to_place', 'city_id');
        $this->dropColumn('user_sexual', 'city_id');
        $this->dropColumn('user_body', 'city_id');
        $this->dropColumn('user_service', 'city_id');
        $this->dropColumn('user_national', 'city_id');
        $this->dropColumn('user_financial_situation', 'city_id');
        $this->dropColumn('user_zhigalo', 'city_id');
        $this->dropColumn('user_interesting', 'city_id');
        $this->dropColumn('user_professionals', 'city_id');
        $this->dropColumn('user_vneshnost', 'city_id');
        $this->dropColumn('user_vajnoe_v_partnere', 'city_id');
        $this->dropColumn('user_children', 'city_id');
        $this->dropColumn('user_family', 'city_id');
        $this->dropColumn('user_celi_znakomstvamstva', 'city_id');
        $this->dropColumn('user_haracter', 'city_id');
        $this->dropColumn('user_life_goals', 'city_id');
        $this->dropColumn('user_smoking', 'city_id');
        $this->dropColumn('user_alcogol', 'city_id');
        $this->dropColumn('user_celi_znakomstvamstva', 'city_id');
        $this->dropColumn('user_breast_size', 'city_id');
        $this->dropColumn('user_intim_hair', 'city_id');
        $this->dropColumn('user_pol', 'city_id');
        $this->dropColumn('user_hair_color', 'city_id');
    }
}
