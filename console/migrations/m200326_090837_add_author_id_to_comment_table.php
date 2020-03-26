<?php

use yii\db\Migration;

/**
 * Class m200326_090837_add_author_id_to_comment_table
 */
class m200326_090837_add_author_id_to_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'author_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comments', 'author_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_090837_add_author_id_to_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
