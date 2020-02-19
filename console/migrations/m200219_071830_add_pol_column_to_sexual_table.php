<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sexual}}`.
 */
class m200219_071830_add_pol_column_to_sexual_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sexual', 'pol_id', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('sexual', 'pol_id');
    }
}
