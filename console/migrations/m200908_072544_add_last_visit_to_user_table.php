<?php

use yii\db\Migration;

/**
 * Class m200908_072544_add_last_visit_to_user_table
 */
class m200908_072544_add_last_visit_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'last_visit_time', $this->integer()->unsigned()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'last_visit_time');
    }
}
