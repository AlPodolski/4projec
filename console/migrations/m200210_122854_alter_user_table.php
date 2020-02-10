<?php

use yii\db\Migration;

/**
 * Class m200210_122854_alter_user_table
 */
class m200210_122854_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'pol', $this->smallInteger());
        $this->addColumn('user', 'phone', $this->string(20));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'pol');
        $this->dropColumn('user', 'phone');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200210_122854_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
