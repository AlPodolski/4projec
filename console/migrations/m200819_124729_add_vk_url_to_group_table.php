<?php

use yii\db\Migration;

/**
 * Class m200819_124729_add_vk_url_to_group_table
 */
class m200819_124729_add_vk_url_to_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('group', 'vk_url', $this->string(122));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200819_124729_add_vk_url_to_group_table cannot be reverted.\n";

        return false;
    }

}
