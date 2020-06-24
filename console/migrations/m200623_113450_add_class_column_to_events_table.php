<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%events}}`.
 */
class m200623_113450_add_class_column_to_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('events', 'class', $this->string(122));
        $this->addColumn('events', 'related_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('events', 'class');
        $this->dropColumn('events', 'related_id');
    }
}
