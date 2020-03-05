<?php

use yii\db\Migration;

/**
 * Class m200305_120939_add_city_id_to_user_brest
 */
class m200305_120939_add_city_id_to_user_brest extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_breast', 'city_id', $this->smallInteger() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_breast', 'city_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200305_120939_add_city_id_to_user_brest cannot be reverted.\n";

        return false;
    }
    */
}
