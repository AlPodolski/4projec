<?php

use yii\db\Migration;

/**
 * Class m200228_143534_drop_pol_column_from_hair_color
 */
class m200228_143534_drop_pol_column_from_hair_color extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('hair_color', 'pol');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('hair_color', 'pol', $this->smallInteger());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200228_143534_drop_pol_column_from_hair_color cannot be reverted.\n";

        return false;
    }
    */
}
