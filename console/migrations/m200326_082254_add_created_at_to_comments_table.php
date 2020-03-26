<?php

use yii\db\Migration;

/**
 * Class m200326_082254_add_created_at_to_comments_table
 */
class m200326_082254_add_created_at_to_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'created_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comments', 'created_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_082254_add_created_at_to_comments_table cannot be reverted.\n";

        return false;
    }
    */
}
