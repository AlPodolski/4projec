<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%service}}`.
 */
class m200220_070831_add_pol_column_to_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('service', 'pol', $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('service', 'pol');
    }
}
