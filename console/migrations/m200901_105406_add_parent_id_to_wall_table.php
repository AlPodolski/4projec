<?php

use yii\db\Migration;

/**
 * Class m200901_105406_add_parent_id_to_wall_table
 */
class m200901_105406_add_parent_id_to_wall_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('wall', 'parent_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('wall', 'parent_id');
    }

}
