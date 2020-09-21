<?php

use yii\db\Migration;

/**
 * Class m200921_114042_add_related_id_to_wall_table
 */
class m200921_114042_add_related_id_to_wall_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200921_114042_add_related_id_to_wall_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200921_114042_add_related_id_to_wall_table cannot be reverted.\n";

        return false;
    }
    */
}
