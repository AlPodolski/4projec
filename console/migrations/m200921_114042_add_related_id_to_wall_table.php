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
        $this->addColumn('wall', 'related_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('wall', 'related_id');
    }

}
