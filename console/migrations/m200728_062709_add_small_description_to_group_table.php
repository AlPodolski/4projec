<?php

use yii\db\Migration;

/**
 * Class m200728_062709_add_small_description_to_group_table
 */
class m200728_062709_add_small_description_to_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('group', 'description', $this->string(255)->comment('Описание к группе'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('group', 'description');
    }
}
